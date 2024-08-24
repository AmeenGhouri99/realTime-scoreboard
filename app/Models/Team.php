<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'logo', // Assuming you might have a logo or image path
        'description', // Optional: A brief description of the team
    ];

    // If you have timestamps in your table, you can use this property
    public $timestamps = true;

    // Define relationships if any
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function matchesAsTeam1()
    {
        return $this->hasMany(CricketMatch::class, 'team_1_id');
    }

    public function matchesAsTeam2()
    {
        return $this->hasMany(CricketMatch::class, 'team_2_id');
    }

    public function matchesWon()
    {
        return $this->hasMany(CricketMatch::class, 'winner_team_id');
    }
}
