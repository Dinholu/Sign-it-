<?php

namespace App\Http\Controllers;

use App\Models\Seal;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Termwind\render;

class SealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $path = public_path('/hello.pdf');
        $pdf->setSourceFile($path);
        $tplId = $pdf->importPage(1);
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, null, null, null, 210, true);

        // Now this details we are going to print in pdf.
        // Horizontal and veritcal setXY


        $pdf->SetXY(40, 40);
        // Details you want to print

        // Now let's change details an position
        $pdf->Write(0.1, "BBUniversal");

        // let's bring another below it

        // Second details
        $pdf->SetXY(40, 50);
        $pdf->Write(0.1, "Thank you. If you have any doubt.");

        $pdf->SetXY(40, 60);
        $pdf->Write(0.1, "Feel free to comment.");
        $pdf->Output(public_path("hello1.pdf"), "F");

        $fileHash = sha1_file(public_path("hello.pdf"));

        Seal::create([
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
