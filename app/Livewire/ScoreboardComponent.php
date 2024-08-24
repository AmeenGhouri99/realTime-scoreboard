<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Match;
use App\Models\Player;
use App\Models\Ball;
use App\Models\CricketMatch;

class ScoreboardComponent extends Component
{
    public $match, $battingTeam, $bowlingTeam;

    public function mount($matchId)
    {
        $this->match = CricketMatch::find($matchId);
        $this->battingTeam = $this->match->battingTeam;
        $this->bowlingTeam = $this->match->bowlingTeam;
    }

    public function render()
    {
        dd($this->battingTeam);
        $batsmen = Player::where('team_id', $this->battingTeam->id)->get();
        $bowlers = Player::where('team_id', $this->bowlingTeam->id)->get();
        $balls = Ball::where('match_id', $this->match->id)->get();

        return view('livewire.scoreboard-component', compact('batsmen', 'bowlers', 'balls'));
    }
}
