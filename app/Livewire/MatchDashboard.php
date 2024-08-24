<?php

namespace App\Livewire;

use App\Models\Ball;
use Livewire\Component;
use App\Models\Player;
use App\Models\Team;

class MatchDashboard extends Component
{
    public $teams;
    public $batting_team_id;
    public $bowlers = [];
    public $batsmen = [];
    public $current_bowler_id;
    public $current_batsman_id;

    public function mount()
    {
        $this->teams = Team::all();
    }

    public function updatedBattingTeamId($batting_team_id)
    {
        // Get batsmen of the selected batting team
        $this->batsmen = Player::where('team_id', $batting_team_id)->where('status', '!=', 'out')->get();

        // Get bowlers of the other team
        $bowling_team_id = $this->getBowlingTeamId();
        $this->bowlers = Player::where('team_id', $bowling_team_id)->get();
    }

    private function getBowlingTeamId()
    {
        // Assuming you have two teams only
        return $this->teams->where('id', '!=', $this->batting_team_id)->first()->id;
    }

    public function addBall()
    {
        // Your logic to handle adding a ball and saving the data
        // For example:
        $this->validate([
            'current_bowler_id' => 'required',
            'current_batsman_id' => 'required',
            'runs' => 'required|integer|min=0',
        ]);

        Ball::create([
            'over_id' => $this->currentOver->id,
            'ball_number' => $this->currentBallNumber,
            'bowler_id' => $this->current_bowler_id,
            'batsman_id' => $this->current_batsman_id,
            'runs' => $this->runs,
            'is_wicket' => $this->is_wicket,
            'is_four' => $this->is_four,
            'is_six' => $this->is_six,
            'is_extra' => $this->is_extra,
        ]);

        $this->resetInputFields();  // Reset input fields after adding
    }


    // public function updateScores($ball)
    // {
    //     // Fetch current over or create new
    //     $over = Over::firstOrCreate([
    //         'match_id' => $this->match_id,
    //         'over_number' => $this->over_number,
    //     ], [
    //         'bowler_id' => $this->current_bowler_id,
    //     ]);

    //     // Update batsman score
    //     $batsmanScore = BatsmanScore::firstOrCreate([
    //         'match_id' => $this->match_id,
    //         'batsman_id' => $this->current_batsman_id,
    //     ]);

    //     $batsmanScore->runs += $this->runs;
    //     $batsmanScore->balls_faced += 1;
    //     $batsmanScore->fours += $this->is_four ? 1 : 0;
    //     $batsmanScore->sixes += $this->is_six ? 1 : 0;
    //     $batsmanScore->save();

    //     // Update bowler performance
    //     $bowlerPerformance = BowlerPerformance::firstOrCreate([
    //         'match_id' => $this->match_id,
    //         'bowler_id' => $this->current_bowler_id,
    //     ]);

    //     $bowlerPerformance->overs_bowled += $this->ball_number % 6 == 0 ? 1 : 0;
    //     $bowlerPerformance->runs_conceded += $this->runs;
    //     $bowlerPerformance->wickets += $this->is_wicket ? 1 : 0;
    //     $bowlerPerformance->save();

    //     // Update overs left
    //     $this->overs_left = $this->total_overs - Over::where('match_id', $this->match_id)->count();
    // }

    // public function resetBallInput()
    // {
    //     $this->current_bowler_id = '';
    //     $this->current_batsman_id = '';
    //     $this->ball_number = '';
    //     $this->runs = '';
    //     $this->is_wicket = false;
    //     $this->is_four = false;
    //     $this->is_six = false;
    //     $this->is_extra = false;
    // }
    public function render()
    {
        return view('livewire.match-dashboard');
    }
}
