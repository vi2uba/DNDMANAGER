<?php

namespace App\Http\Controllers;

use App\Models\Campaign_Session;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create($campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $users = User::where('id', '!=', auth()->id())->get();
        return view('sessions.create', compact('campaign', 'users'));
    }

    public function store(Request $request, $campaign_id)
    {
        $request->validate([
            'session_date' => 'required|date',
            'notes' => 'nullable|string',
            'attendees' => 'required|array'
        ]);

        $session = Campaign_Session::create([
            'campaign_id' => $campaign_id,
            'session_date' => $request->session_date,
            'notes' => $request->notes
        ]);

        $session->attendees()->attach($request->attendees, ['status' => 'pending']);

        return redirect()->route('campaign.show', $campaign_id)
            ->with('success', 'Session created and invitations sent.');
    }
}
