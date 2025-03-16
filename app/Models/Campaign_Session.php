<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign_Session extends Model
{
    protected $fillable = [
        'campaign_id',
        'session_date',
        'notes'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'session_attendees');
    }
}
