<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Seal;
use Inertia\Inertia;
use App\Models\Meeting;
use Inertia\Controller;
use setasign\Fpdi\Fpdi;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $meetings = Meeting::orderBy('date', 'asc')->with(["participant"])->get();

        return Inertia::render('meeting/Index', [
            'meetings' => $meetings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('meeting/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:45',
            'description' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'date' => 'required',
            'closing' => 'required',
            'privilege' => 'required|string',
            'slug' => 'required|string|max:45|unique:meetings'
        ]);
        $meeting = Meeting::create($data);

        $admin = Auth::user();

        $admindata = [
            'name' => $admin->name,
            'firstname' => $admin->firstname,
            'email' => $admin->email,
            'phone' => $admin->phone,
            'ip' => $admin->ip,
            'meeting_id' => $meeting->id,
            'user_id' => $admin->id,
        ];
        $data = Participant::create($admindata);
        return redirect()->route('index')->with('message', 'La Réunion a été créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        if (Auth::user()) {
            $participants = $meeting->participant;
            foreach ($participants as $participant) {
                if (Auth::user()->id == $participant->user_id) {
                    return redirect()->route('index')->with('message', 'Vous êtes déjà inscrit à cette réunion');
                }
            }
        } else if ($meeting->privilege == 'private') {
            if (Auth::check()) {
                return Inertia::render('meeting/Show', [
                    'meeting' => $meeting,
                ]);
            } else {
                return redirect()->route('index')->with('message', 'Vous devez être connecté pour accéder à cette réunion');
            }
        }


        return Inertia::render('meeting/Show', [
            'meeting' => $meeting,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        return Inertia::render('meeting/Edit', [
            'meeting' => $meeting,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */

    public function close(Meeting $meeting)
    {
        $meeting->update([
            'closing' => Carbon::now(),
            'statut' => 'close',
        ]);

        $token = Str::random($length = 15);
        $path = 'pdftest.pdf';

        // $file = storage_path('app/' . $path);
        $image = storage_path('app/encart.png');

        $pdf = new Fpdi('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->setSourceFile(storage_path('app/' . $path));
        $tplId = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($tplId);
        $pdf->useTemplate($tplId, 1, 1, $size['width'], $size['height'], TRUE);

        $pdf->SetXY(15, 20);
        $pdf->SetFont("");
        $pdf->Write(15, 'Reunion du ' . $meeting->date);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetXY(15, 30);
        $pdf->Write(15, 'Ordre du jour : ' . iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $meeting->title));
        $pdf->SetXY(15, 40);
        $pdf->SetFont("");

        $pdf->Write(15, 'Lieu : ' . iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $meeting->place));
        $pdf->SetXY(15, 60);
        $pdf->Write(15, 'Description : ' . iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $meeting->description));
        $pdf->SetXY(15, 70);
        $pdf->Write(15, 'Date de cloture : ' . $meeting->closing);
        $pdf->SetXY(15, 80);
        $pdf->Write(15, 'Participants:');
        $pdf->SetXY(15, 90);
        foreach ($meeting->participant as $participant) {
            $pdf->Write(15, iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $participant->name . ' ' . $participant->firstname));
            $pdf->SetXY(15, $pdf->GetY() + 10);
        }
        // $xxx_final = ($size['width'] - 60);
        // $yyy_final = ($size['height'] - 20);
        // $pdf->Image($image, $xxx_final, $yyy_final, 40, 20, 'PNG');
        $pathOutput = storage_path('app/pdf/' . $meeting->slug . '.pdf');
        $pdf->Output($pathOutput, "F");
        $fileHash = sha1_file($pathOutput);

        Seal::create([
            'path' => $meeting->slug . '.pdf',
            'token' => $token,
            'sha1' => $fileHash,
            'meeting_id' => $meeting->id,
        ]);

        return redirect()->route('index')->with('message', 'La réunion a été cloturée avec succès');
    }

    public function update(Request $request, Meeting $meeting)
    {
        $attributes = request()->validate([
            'title' => 'required|string|max:45',
            'description' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'date' => 'required',
            'closing' => 'required',
            'privilege' => 'required|string',
        ]);
        $meeting->update($attributes);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return back();
    }
}
