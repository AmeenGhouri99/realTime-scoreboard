<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'team_id',
        'position',
        'runs_scored',
        'balls_faced',
        'sixes',
        'fours',
        'total_runs',
    ];

    // If you have timestamps in your table, you can use this property
    public $timestamps = true;

    // Define relationships if any
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
