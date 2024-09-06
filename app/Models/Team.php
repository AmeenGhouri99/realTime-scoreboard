<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'tournament_id', // Assuming you might have a logo or image path
        // Optional: A brief description of the team
    ];

    // If you have timestamps in your table, you can use this property
    public $timestamps = true;

    // Define relationships if any
    /**
     * Get all of the comments for the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Team1Match(): HasMany
    {
        return $this->hasMany(CricketMatch::class, 'team1_id');
    }
    public function Team2Match(): HasMany
    {
        return $this->hasMany(CricketMatch::class, 'team2_id');
    }
    /**
     * Get the tournament that owns the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }
}
