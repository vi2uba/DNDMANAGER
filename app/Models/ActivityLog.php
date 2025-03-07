<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $table = 'activity_logs';
    protected $fillable = ['description', 'user_email', 'module'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }
}
