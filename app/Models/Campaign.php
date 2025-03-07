<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns'; // Specify the custom table name
    protected $guarded = [];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function soundEffects()
    {
        return $this->hasMany(SoundEffect::class);
    }

    public function diceRolls()
    {
        return $this->hasMany(DiceRoll::class);
    }
}
