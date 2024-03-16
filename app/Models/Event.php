<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'event_name',
        'event_points',
        'event_type',
        'competition_id',
        'start_date',
        'expire_date'
    ];
    use HasFactory;
}
