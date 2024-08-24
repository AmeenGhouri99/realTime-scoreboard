<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Over extends Model
{
    use HasFactory;
    protected $table = 'overs';
    protected $fillable = [
        'match_id',
        'over_number',
        'bowler_id',
    ];
}
