<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerStats extends Model
{
    use HasFactory;
    protected $table = 'players_stats';

    protected $fillable = [
        'scoreboard_id',
        'player_id',
        'is_on_strike',
        'runs',
        'is_out',
        'ball_faced',
    ];

    public function match()
    {
        return $this->belongsTo(CricketMatch::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
