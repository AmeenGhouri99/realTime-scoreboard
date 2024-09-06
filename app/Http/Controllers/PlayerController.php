<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function store(Request $request)
    {
        $firstPlayer = Player::create([
            'name' => $request->input('first_player_name'),
            'team_id' => $request->input('team1_id'),
        ]);

        $secondPlayer = Player::create([
            'name' => $request->input('second_player_name'),
            'team_id' => $request->input('team2_id'),
        ]);

        $players = Player::whereIn('team_id', [$request->input('team1_id'), $request->input('team2_id')])->get();

        return response()->json(['players' => $players]);
    }
}
