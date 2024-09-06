<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function playerStats()
    {
        return $this->hasMany(PlayerStats::class);
    }

    public function bowlerStats()
    {
        return $this->hasMany(BowlerStats::class);
    }
}
