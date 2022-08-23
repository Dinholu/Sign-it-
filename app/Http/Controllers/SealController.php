<?php

namespace App\Http\Controllers;

use App\Models\Seal;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('hello');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hello = Str::random($length = 15);
        $path = request()->file('file')->store('pdf');
        // return "done " . $path;


        // $file = storage_path('app/' . $path);
        $image = storage_path('app/encart.png');

        $pdf = new Fpdi();
        $pdf->AddPage();
        // $pdf->SetFont('Arial', 'B', 16);
        $pdf->setSourceFile(storage_path('app/' . $path));
        $tplId = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($tplId);
        $pdf->useTemplate($tplId, 1, 1, $size['width'], $size['height'], TRUE);


        $xxx_final = ($size['width'] - 60);
        $yyy_final = ($size['height'] - 20);
        $pdf->Image($image, $xxx_final, $yyy_final, 40, 20, 'PNG');
        $pdf->Output(storage_path('app/' . $path), "F");

        $fileHash = sha1_file(storage_path('app/' . $path));


        Seal::create([
            'path' => $path,
            'token' => $hello,
            'sha1' => $fileHash,
        ]);


        return Inertia::render('hello');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seal  $seal
     * @return \Illuminate\Http\Response
     */
    public function show(Seal $seal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seal  $seal
     * @return \Illuminate\Http\Response
     */
    public function edit(Seal $seal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seal  $seal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seal $seal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seal  $seal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seal $seal)
    {
        //
    }
}
