<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'competition_name',
        'num_of_events',
        'description',
        'start_date',
        'expire_date'
    ];

    public $timestamps = false;
    use HasFactory;
}
