<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualCompetitionScore extends Model
{
    protected $table = 'individuals_competitions_score';
    public $timestamps = false;
    protected $fillable = [
        'competition_id',
        'individual_id',
        'total_score'
    ];

    use HasFactory;
}
