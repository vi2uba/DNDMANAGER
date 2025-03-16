@extends('layouts.app', ['page' => __('Add Character'), 'pageSlug' => 'character'])

@section('content')
<div class="container">
    <h2>Create New Character</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('character.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Campaign</label>
                    <select name="campaign_id" class="form-control" id="campaign_id" required>
                        <option value="" style="background-color:#525f7f">--Select Campaign--</option>
                        @foreach ($campaigns as $campaign)
                            <option value="{{ $campaign->id }}" style="background-color:#525f7f" 
                                {{ request()->get('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                {{ $campaign->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>Race</label>
                    <input type="text" name="race" class="form-control" required value="{{ old('race') }}">
                </div>
                <div class="form-group">
                    <label>Class</label>
                    <input type="text" name="class" class="form-control" required value="{{ old('class') }}">
                </div>

                <h4 class="mt-4">Base Stats (Max 27 Points)</h4>
                <p><strong>Remaining Points: <span id="remaining-points">27</span></strong></p>

                @php
                    $stats = ['strength', 'dexterity', 'constitution', 'intelligence', 'wisdom', 'charisma'];
                @endphp

                @foreach ($stats as $stat)
                    <div class="form-group">
                        <label>{{ ucfirst($stat) }}</label>
                        <input type="number" name="{{ $stat }}" 
                               class="form-control stat-input" 
                               value="{{ old($stat, 8) }}" 
                               min="8" max="15" 
                               data-stat="{{ $stat }}">
                    </div>
                @endforeach
            </div>

            <div class="col-md-6">
                <h4>Combat Stats (Auto-Calculated)</h4>
                
                <div class="form-group">
                    <label>Hit Points</label>
                    <input type="number" name="current_hit_points" class="form-control" id="hit-points" readonly>
                </div>
                <div class="form-group">
                    <label>Mana Points</label>
                    <input type="number" name="current_mana_points" class="form-control" id="mana-points" readonly>
                </div>
                <div class="form-group">
                    <label>Stamina Points</label>
                    <input type="number" name="current_stamina_points" class="form-control" id="stamina-points" readonly>
                </div>
                <div class="form-group">
                    <label>Armor Class</label>
                    <input type="number" name="armor_class" class="form-control" id="armor-class" readonly>
                </div>
                <div class="form-group">
                    <label>Initiative</label>
                    <input type="number" name="initiative" class="form-control" id="initiative" readonly>
                </div>
                <div class="form-group">
                    <label>Speed</label>
                    <input type="number" name="speed" class="form-control" value="30" readonly>
                </div>
                <div class="form-group">
                    <label>Hit Dice</label>
                    <input type="number" name="hit_dice" class="form-control" value="1" readonly>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Create Character</button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const statInputs = document.querySelectorAll(".stat-input");
    const maxPoints = 27;
    let remainingPoints = maxPoints;
    let lastValidValues = {};

    function calculateModifier(statValue) {
        return Math.floor((statValue - 10) / 2);
    }

    function updateStats() {
        let totalPointsUsed = 0;
        let stats = { strength: 8, dexterity: 8, constitution: 8, intelligence: 8, wisdom: 8, charisma: 8 };

        statInputs.forEach(input => {
            let value = parseInt(input.value) || 8;

            // Ensure input stays within range
            if (value < 8) value = 8;
            if (value > 15) value = 15;

            stats[input.getAttribute("data-stat")] = value;
            totalPointsUsed += value - 8;
        });

        remainingPoints = maxPoints - totalPointsUsed;

        if (remainingPoints < 0) {
            alert("You have exceeded the allowed stat points!");
            
            // Reset all stats to last valid value
            statInputs.forEach(input => {
                let stat = input.getAttribute("data-stat");
                input.value = lastValidValues[stat] || 8;
            });

            updateStats();
            return;
        }

        document.getElementById("remaining-points").textContent = remainingPoints;

        // Save last valid values
        statInputs.forEach(input => {
            lastValidValues[input.getAttribute("data-stat")] = parseInt(input.value);
        });

        // Combat stats calculation
        document.getElementById("hit-points").value = stats.constitution * 2 + 10;
        document.getElementById("mana-points").value = stats.intelligence * 2;
        document.getElementById("stamina-points").value = stats.strength + stats.dexterity;
        document.getElementById("armor-class").value = 10 + calculateModifier(stats.dexterity);
        document.getElementById("initiative").value = calculateModifier(stats.dexterity);
    }

    statInputs.forEach(input => {
        input.addEventListener("change", updateStats);

        // Prevent manual typing of invalid values
        input.addEventListener("input", function (e) {
            let value = parseInt(this.value);

            if (isNaN(value) || value < 8 || value > 15) {
                this.value = lastValidValues[this.getAttribute("data-stat")] || 8;
            }
        });
    });

    updateStats();
});
</script>

@endsection
