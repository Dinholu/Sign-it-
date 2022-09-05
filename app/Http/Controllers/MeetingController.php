<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Participant;
use Illuminate\Http\Resources\MergeValue;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return Inertia::render('meeting/Index', [
            'meetings' => Auth::user()->meetings,
            'participants' => Participant::all(),
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
            'firstname' => "alizée",
            'email' => $admin->email,
            'phone' => "0606060606",
            'ip' => "123456",
            'meeting_id' => $meeting->id,
            'user_id' => $admin->id,
        ];
        $data = Participant::create($admindata);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {

        $participants = $meeting->participant;
        foreach ($participants as $participant) {
            if ($participant->id == Auth::user()->id) {
                return 'Vous participez déja a cette réunion';
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
