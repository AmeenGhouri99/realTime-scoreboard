<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ball extends Model
{
    use HasFactory;
    protected $table = "balls";
    protected $fillable = [
        'innings_id',
        'bowler_id',
        'batsman_id',
        'ball_number',
        'runs_conceded',
        'ball_type',
        'is_wicket',
        'over_number'
    ];
}