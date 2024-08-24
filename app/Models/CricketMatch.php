<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CricketMatch extends Model
{
    use HasFactory;

    protected $table = 'matches';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'tournament_id',
        'team_1_id',
        'team_2_id',
        'team_1_score',
        'team_2_score',
        'match_date',
        'winner_team_id',
        'status', // e.g., 'scheduled', 'ongoing', 'completed'
        'toss_winner_team_id',
        'decision',
        'batting_team_id',
        'bowling_team_id'
    ];

    // If you have timestamps in your table, you can use this property
    public $timestamps = true;

    // Define relationships if any
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team_1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team_2_id');
    }

    public function winner()
    {
        return $this->belongsTo(Team::class, 'winner_team_id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
