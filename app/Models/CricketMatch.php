<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CricketMatch extends Model
{
    use HasFactory;
    protected $table = "matches";

    protected $fillable = [
        'tournament_id',
        'team1_id',
        'team2_id',
        'team1_runs',
        'team2_runs',
        'team1_extras',
        'team2_extras',
        'which_team_won_the_toss',
        'elected_to_bat',
        'status',
        'total_overs',
        'total_fours_of_team_1',
        'total_sixes_of_team_1',
        'total_fours_of_team_2',
        'total_sixes_of_team_2',
        'total_wickets_of_team1',
        'total_wickets_of_team2',
        'batting_team_id',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function players()
    {
        // return $this->hasMany(PlayerStat::class);
    }

    public function bowlers()
    {
        // return $this->hasMany(BowlerStat::class);
    }
    /**
     * Get the team that owns the CricketMatch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /**
     * Get all of the scoreboard for the CricketMatch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scoreboard(): HasMany
    {
        return $this->hasMany(Score::class, 'match_id');
    }

    /**
     * Get the user that owns the CricketMatch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function battingTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'batting_team_id');
    }
    // public function scoreboard()
    // {
    //     return $this->belongsTo(Score::class, 'match_id');
    // }
}
