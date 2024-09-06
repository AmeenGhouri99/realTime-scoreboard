<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BowlerStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'bowler_id',
        'overs',
        'runs_conceded',
    ];

    public function match()
    {
        return $this->belongsTo(CricketMatch::class);
    }

    public function bowler()
    {
        return $this->belongsTo(Player::class, 'bowler_id');
    }
}
