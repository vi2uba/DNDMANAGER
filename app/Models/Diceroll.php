<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diceroll extends Model
{
    protected $table = 'dicerolls';
    protected $guarded = [];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
