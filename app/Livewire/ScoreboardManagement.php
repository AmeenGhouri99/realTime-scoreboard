<?php

namespace App\Livewire;

use App\Models\CricketMatch;
use Livewire\Component;
use App\Models\Player;

class ScoreboardManagement extends Component
{
    public $match, $team1, $team2;
    public $team1_runs, $team1_wickets, $team1_overs;
    public $team2_runs, $team2_wickets, $team2_overs;
    public $batsman1_name, $batsman1_runs, $batsman1_balls;
    public $bowler_name, $bowler_wickets, $bowler_runs;
    public $battingTeamId, $bowlingTeamId;

    public function mount($matchId)
    {
        $this->match = CricketMatch::find($matchId);
        $this->team1 = $this->match->team1;
        $this->team2 = $this->match->team2;

        // Determine batting and bowling teams based on toss decision
        if ($this->match->decision === 'bat') {
            $this->battingTeamId = $this->match->batting_team_id;
            $this->bowlingTeamId = $this->match->bowling_team_id;
        } else {
            $this->battingTeamId = $this->match->bowling_team_id;
            $this->bowlingTeamId = $this->match->batting_team_id;
        }

        // Initialize properties with existing match data
        $this->team1_runs = $this->match->team1_runs ?? 0;
        $this->team1_wickets = $this->match->team1_wickets ?? 0;
        $this->team1_overs = $this->match->team1_overs ?? 0;

        $this->team2_runs = $this->match->team2_runs ?? 0;
        $this->team2_wickets = $this->match->team2_wickets ?? 0;
        $this->team2_overs = $this->match->team2_overs ?? 0;

        $this->batsman1_name = '';
        $this->batsman1_runs = 0;
        $this->batsman1_balls = 0;

        $this->bowler_name = '';
        $this->bowler_wickets = 0;
        $this->bowler_runs = 0;
    }

    public function getBattingTeamPlayers()
    {
        return Player::where('team_id', $this->battingTeamId)->where('position', 'batsman')->get();
    }

    public function getBowlingTeamPlayers()
    {
        return Player::where('team_id', $this->bowlingTeamId)->where('position', 'bowler')->get();
    }

    public function render()
    {
        return view('livewire.scoreboard-management', [
            'battingTeamPlayers' => $this->getBattingTeamPlayers(),
            'bowlingTeamPlayers' => $this->getBowlingTeamPlayers(),
        ]);
    }
}
