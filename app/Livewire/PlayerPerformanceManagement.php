<?php

namespace App\Livewire;

use App\Models\BowlerPerformance;
use App\Models\BatsmanScore;
use App\Models\Ball;
use App\Models\CricketMatch;
use App\Models\Over;
use App\Models\Match;
use App\Models\Player;
use Livewire\Component;

class PlayerPerformanceManagement extends Component
{
    public $matches, $players, $bowlers, $batsmen, $overs;
    public $match_id, $bowler_id, $batsman_id, $over_id, $runs, $balls_faced, $fours, $sixes, $wickets, $overs_bowled, $maidens, $no_balls, $wides, $ball_number, $is_wicket, $is_four, $is_six, $is_extra;
    public $isModalOpen = false;

    public function render()
    {
        $this->matches = CricketMatch::all();
        $this->players = Player::all();
        $this->bowlers = Player::where('position', 'bowler')->get();
        $this->batsmen = Player::where('position', 'batsman')->get();
        $this->overs = Over::all();
        return view('livewire.player-performance-management');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetInputFields()
    {
        $this->match_id = '';
        $this->bowler_id = '';
        $this->batsman_id = '';
        $this->over_id = '';
        $this->runs = '';
        $this->balls_faced = '';
        $this->fours = '';
        $this->sixes = '';
        $this->wickets = '';
        $this->overs_bowled = '';
        $this->maidens = '';
        $this->no_balls = '';
        $this->wides = '';
        $this->ball_number = '';
        $this->is_wicket = false;
        $this->is_four = false;
        $this->is_six = false;
        $this->is_extra = false;
    }

    public function storeBatsmanScore()
    {
        $this->validate([
            'match_id' => 'required|exists:matches,id',
            'batsman_id' => 'required|exists:players,id',
            'runs' => 'required|integer',
            'balls_faced' => 'required|integer',
        ]);

        BatsmanScore::create([
            'match_id' => $this->match_id,
            'batsman_id' => $this->batsman_id,
            'runs' => $this->runs,
            'balls_faced' => $this->balls_faced,
            'fours' => $this->fours,
            'sixes' => $this->sixes,
        ]);

        session()->flash('message', 'Batsman Score Recorded Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function storeBowlerPerformance()
    {
        $this->validate([
            'match_id' => 'required|exists:matches,id',
            'bowler_id' => 'required|exists:players,id',
            'overs_bowled' => 'required|integer',
            'runs_conceded' => 'required|integer',
        ]);

        BowlerPerformance::create([
            'match_id' => $this->match_id,
            'bowler_id' => $this->bowler_id,
            'overs_bowled' => $this->overs_bowled,
            'runs_conceded' => $this->runs,
            'wickets' => $this->wickets,
            'maidens' => $this->maidens,
            'no_balls' => $this->no_balls,
            'wides' => $this->wides,
        ]);

        session()->flash('message', 'Bowler Performance Recorded Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function storeBall()
    {
        $this->validate([
            'over_id' => 'required|exists:overs,id',
            'ball_number' => 'required|integer',
            'bowler_id' => 'required|exists:players,id',
            'batsman_id' => 'required|exists:players,id',
            'runs' => 'required|integer',
        ]);

        Ball::create([
            'over_id' => $this->over_id,
            'ball_number' => $this->ball_number,
            'bowler_id' => $this->bowler_id,
            'batsman_id' => $this->batsman_id,
            'runs' => $this->runs,
            'is_wicket' => $this->is_wicket,
            'is_four' => $this->is_four,
            'is_six' => $this->is_six,
            'is_extra' => $this->is_extra,
        ]);

        session()->flash('message', 'Ball Data Recorded Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }
}
