<?php

namespace App\Http\Controllers;

use App\Models\Seal;
use Inertia\Inertia;
use App\Models\Meeting;
use setasign\Fpdi\Fpdi;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seals = Seal::all();
        foreach ($seals as $seal) {
            $seal->meeting = Meeting::find($seal->meeting_id);
        };

        return Inertia::render('seal/Index', [
            'seals' => $seals,
        ]);
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
        //
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

    public function download(Seal $seal)
    {
        return Storage::download('pdf/' . $seal->path, $seal->name);
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
