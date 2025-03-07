<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'characters';
    protected $guarded = [];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function diceRolls()
    {
        return $this->hasMany(DiceRoll::class);
    }

    public function soundEffects()
    {
        return $this->belongsToMany(SoundEffect::class);
    }
}
