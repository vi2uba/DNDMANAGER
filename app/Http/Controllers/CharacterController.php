<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Character;
use Illuminate\Http\Request;
use App\Models\Inventory;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::where('user_id', auth()->id())->get();
        return view('characters.character-view', compact('characters'));
    }

    public function create()
    {
        // Get all campaigns where the user is the dungeon master
        $campaigns = Campaign::where('dungeon_master_id', auth()->id())->get();
        return view('characters.character-add', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'race' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'campaign_id' => 'required',
            'strength' => 'required|integer|min:1',
            'dexterity' => 'required|integer|min:1',
            'constitution' => 'required|integer|min:1',
            'intelligence' => 'required|integer|min:1',
            'wisdom' => 'required|integer|min:1',
            'charisma' => 'required|integer|min:1',
            'current_hit_points' => 'required|integer|min:1',
            'current_mana_points' => 'required|integer|min:0',
            'current_stamina_points' => 'required|integer|min:0',
            'armor_class' => 'required|integer|min:1',
            'initiative' => 'required|integer',
            'speed' => 'required|integer|min:1',
            'hit_dice' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = auth()->id();

        // Create the character and store it in a variable
        $character = Character::create($validated);
        
        // Get the newly created character's ID
        $character_id = $character->id;
        
        // Automatically Create Inventory for the Character
        $inventory = new Inventory();
        $inventory->character_id = $character_id;
        $inventory->save();
        
        return redirect()->route('character.index', $request->campaign_id)
            ->with('success', 'Character created successfully');
    }

    public function edit(Request $request, Character $character)
    {
        $character = Character::find($request->id);
        return view('characters.character-edit', compact('character'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'race' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'strength' => 'required|integer|min:1',
            'dexterity' => 'required|integer|min:1',
            'constitution' => 'required|integer|min:1',
            'intelligence' => 'required|integer|min:1',
            'wisdom' => 'required|integer|min:1',
            'charisma' => 'required|integer|min:1',
            'current_hit_points' => 'required|integer|min:1',
            'current_mana_points' => 'required|integer|min:0',
            'current_stamina_points' => 'required|integer|min:0',
            'armor_class' => 'required|integer|min:1',
            'initiative' => 'required|integer',
            'speed' => 'required|integer|min:1',
            'hit_dice' => 'required|integer|min:1',
        ]);

        $character = Character::find($request->id);
        $character->update($validated);

        return redirect()->route('character.index', $character->campaign_id)
            ->with('success', 'Character updated successfully');
    }
}
