<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerChangeLog extends Model
{
    use HasFactory;
    protected $table = "player_change_logs";
    protected $fillable = [
        'scoreboard_id',
        'previous_player_id',
        'new_player_id',
        'position'
    ];
}
