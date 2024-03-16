<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualEventScore extends Model
{
    protected $table = 'individuals_events_score';
    public $timestamps = false;
    protected $fillable = [
        'individual_id',
        'event_id',
        'event_score'
    ];
    use HasFactory;
}
