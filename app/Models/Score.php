<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    use HasFactory;
    protected $table = 'scores';
    protected $fillable = [
        'team_id',
        'match_id',
        'first_player_name',
        'second_player_name',
        'total_scores',
        'first_player_runs',
        'second_player_runs',
        'first_player_ball_faced',
        'second_player_ball_faced',
        'extra',
        'bowler_name',
        'bowler_ball_faced',
        'bowler_overs',
        'bowler_runs',
        'target',
        'innings',
        'overs_done',
        'innings',
        'total_wickets',
        'bowler_wickets'
    ];
    /**
     * Get the user that owns the Score
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function match(): BelongsTo
    {
        return $this->belongsTo(CricketMatch::class, 'match_id');
    }
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
