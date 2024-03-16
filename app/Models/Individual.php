<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    protected $fillable = [
        'user_id',
        'competition_id',
        'team_name'
    ];
    use HasFactory;
}
