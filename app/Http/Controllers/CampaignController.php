<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        //Return all campaigns related to the user
        $campaigns = Campaign::where('dungeon_master_id', auth()->user()->id)->get();
        return view('campaign.campaign-view', compact('campaigns'));
    }

    public function add()
    {
        return view('campaign.campaign-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

     

        Campaign::create([
            'name' => $request->name,
            'description' => $request->description,
            'dungeon_master_id' => auth()->user()->id,
        ]);

        return redirect()->route('campaign.index')->with('success', 'Campaign created successfully.');
    }

    public function show($id)
    {
        $campaign = Campaign::find($id);
        return view('campaign.campaign-show', compact('campaign'));
    }

    public function edit($id)
    {
        $campaign = Campaign::find($id);
        return view('campaign.campaign-edit', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'goal' => 'required',
            'end_date' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $campaign = Campaign::find($id);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $campaign->image = $imageName;
        }

        $campaign->title = $request->title;
        $campaign->description = $request->description;
        $campaign->goal = $request->goal;
        $campaign->end_date = $request->end_date;
        $campaign->save();

        return redirect()->route('campaign.index')->with('success', 'Campaign updated successfully.');
    }

    public function destroy($id)
    {
        $campaign = Campaign::find($id);
        $campaign->delete();
        return redirect()->route('campaign.index')->with('success', 'Campaign deleted successfully.');
    }
}
