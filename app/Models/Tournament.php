<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $table = 'tournaments';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'user_id',
        'start_date',
        'end_date',
        'location', // Optional: where the tournament is held
        'status',   // e.g., 'planned', 'ongoing', 'completed'
    ];

    // If you have timestamps in your table, you can use this property
    public $timestamps = true;

    // Define relationships if any
    public function matches()
    {
        return $this->hasMany(CricketMatch::class);
    }
}
