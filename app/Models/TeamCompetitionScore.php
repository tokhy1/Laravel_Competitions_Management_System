<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamCompetitionScore extends Model
{
    protected $table = 'teams_competitions_score';
    public $timestamps = false;
    protected $fillable = [
        'competition_id',
        'team_id',
        'total_score'
    ];
    use HasFactory;
}
