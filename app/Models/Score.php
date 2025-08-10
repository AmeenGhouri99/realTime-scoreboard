<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Score extends Model
{
    use HasFactory;
    protected $table = 'scores';
    protected $fillable = [
        'team_id',
        'match_id',
        'total_scores',
        'player1_id',
        'player2_id',
        'bowler_id',
        'extra',
        'target',
        'innings',
        'overs_done',
        'innings',
        'total_wickets',
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
    public function player1(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player1_id');
    }
    public function player2(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player2_id');
    }
    public function bowler(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'bowler_id');
    }
    public function playerStats(): HasMany
    {
        return $this->hasMany(PlayerStats::class, 'innings_id');
    }
    public function bowlersStats(): HasMany
    {
        return $this->hasMany(BowlerStats::class, 'innings_id');
    }
    public function ball(): HasMany
    {
        return $this->hasMany(Ball::class, 'innings_id');
    }
}
