<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Meeting;
use Inertia\Controller;

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
        $meetings = Meeting::join('participants', 'meetings.id', '=', 'participants.meeting_id')
            ->where('participants.user_id', Auth::user()->id)
            ->select('meetings.*')
            ->get();

        return Inertia::render('meeting/Index', [
            'meetings' => $meetings,
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
