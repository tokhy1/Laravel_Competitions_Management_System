<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamEventScore extends Model
{
    protected $table = 'teams_events_score';
    public $timestamps = false;
    protected $fillable = [
        'team_id',
        'event_id',
        'event_score',
    ];

    use HasFactory;
}
