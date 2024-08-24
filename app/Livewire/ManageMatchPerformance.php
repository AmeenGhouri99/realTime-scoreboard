<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Over;
use App\Models\Ball;
use App\Models\BatsmanScore;
use App\Models\BowlerPerformance;
use App\Models\CricketMatch;
use App\Models\Player;

class ManageMatchPerformance extends Component
{
    public $matchId;
    public $overs, $bowlers, $batsmen;

    // For managing the Over form
    public $overNumber, $bowlerId, $overId;

    // For managing the Ball form
    public $ballNumber, $batsmanId, $runs, $isWicket, $isFour, $isSix, $isExtra, $overIdForBall, $ballId;

    // For managing Batsman performance form
    public $batsmanPerformanceId, $runsScored, $ballsFaced, $fours, $sixes, $dismissedBy;

    // For managing Bowler performance form
    public $bowlerPerformanceId, $oversBowled, $runsConceded, $wickets, $maidens, $noBalls, $wides;

    public function mount($matchId)
    {
        $this->matchId = $matchId;
        $this->loadData();
    }

    public function loadData()
    {
        $this->overs = Over::with('balls')->where('match_id', $this->matchId)->get();
        $this->bowlers = BowlerPerformance::where('match_id', $this->matchId)->get();
        $this->batsmen = BatsmanScore::where('match_id', $this->matchId)->get();
    }

    // CRUD for Overs
    public function createOrUpdateOver()
    {
        dd($this);

        $this->validate([
            'overNumber' => 'required|integer',
            'bowlerId' => 'required|exists:players,id',
        ]);

        Over::updateOrCreate(['id' => $this->overId], [
            'match_id' => $this->matchId,
            'over_number' => $this->overNumber,
            'bowler_id' => $this->bowlerId,
        ]);

        $this->resetOverInputFields();
        $this->loadData();
    }

    public function editOver($id)
    {
        $over = Over::findOrFail($id);
        $this->overId = $id;
        $this->overNumber = $over->over_number;
        $this->bowlerId = $over->bowler_id;
    }

    public function deleteOver($id)
    {
        Over::findOrFail($id)->delete();
        $this->loadData();
    }

    public function resetOverInputFields()
    {
        $this->overId = null;
        $this->overNumber = null;
        $this->bowlerId = null;
    }

    // CRUD for Balls
    public function createOrUpdateBall()
    {
        $this->validate([
            'ballNumber' => 'required|integer',
            'batsmanId' => 'required|exists:players,id',
            'runs' => 'required|integer',
        ]);

        Ball::updateOrCreate(['id' => $this->ballId], [
            'over_id' => $this->overIdForBall,
            'ball_number' => $this->ballNumber,
            'batsman_id' => $this->batsmanId,
            'runs' => $this->runs,
            'is_wicket' => $this->isWicket,
            'is_four' => $this->isFour,
            'is_six' => $this->isSix,
            'is_extra' => $this->isExtra,
        ]);

        $this->resetBallInputFields();
        $this->loadData();
    }

    public function editBall($id)
    {
        $ball = Ball::findOrFail($id);
        $this->ballId = $id;
        $this->ballNumber = $ball->ball_number;
        $this->batsmanId = $ball->batsman_id;
        $this->runs = $ball->runs;
        $this->isWicket = $ball->is_wicket;
        $this->isFour = $ball->is_four;
        $this->isSix = $ball->is_six;
        $this->isExtra = $ball->is_extra;
        $this->overIdForBall = $ball->over_id;
    }

    public function deleteBall($id)
    {
        Ball::findOrFail($id)->delete();
        $this->loadData();
    }

    public function resetBallInputFields()
    {
        $this->ballId = null;
        $this->ballNumber = null;
        $this->batsmanId = null;
        $this->runs = null;
        $this->isWicket = null;
        $this->isFour = null;
        $this->isSix = null;
        $this->isExtra = null;
    }

    // CRUD for Batsman Performance
    public function createOrUpdateBatsmanPerformance()
    {
        $this->validate([
            'batsmanId' => 'required|exists:players,id',
            'runsScored' => 'required|integer',
            'ballsFaced' => 'required|integer',
        ]);

        BatsmanScore::updateOrCreate(['id' => $this->batsmanPerformanceId], [
            'match_id' => $this->matchId,
            'batsman_id' => $this->batsmanId,
            'runs' => $this->runsScored,
            'balls_faced' => $this->ballsFaced,
            'fours' => $this->fours,
            'sixes' => $this->sixes,
            'dismissed_by' => $this->dismissedBy,
        ]);

        $this->resetBatsmanInputFields();
        $this->loadData();
    }

    public function editBatsmanPerformance($id)
    {
        $performance = BatsmanScore::findOrFail($id);
        $this->batsmanPerformanceId = $id;
        $this->batsmanId = $performance->batsman_id;
        $this->runsScored = $performance->runs;
        $this->ballsFaced = $performance->balls_faced;
        $this->fours = $performance->fours;
        $this->sixes = $performance->sixes;
        $this->dismissedBy = $performance->dismissed_by;
    }

    public function deleteBatsmanPerformance($id)
    {
        BatsmanScore::findOrFail($id)->delete();
        $this->loadData();
    }

    public function resetBatsmanInputFields()
    {
        $this->batsmanPerformanceId = null;
        $this->batsmanId = null;
        $this->runsScored = null;
        $this->ballsFaced = null;
        $this->fours = null;
        $this->sixes = null;
        $this->dismissedBy = null;
    }

    // CRUD for Bowler Performance
    public function createOrUpdateBowlerPerformance()
    {
        $this->validate([
            'bowlerId' => 'required|exists:players,id',
            'oversBowled' => 'required|integer',
            'runsConceded' => 'required|integer',
        ]);

        BowlerPerformance::updateOrCreate(['id' => $this->bowlerPerformanceId], [
            'match_id' => $this->matchId,
            'bowler_id' => $this->bowlerId,
            'overs_bowled' => $this->oversBowled,
            'runs_conceded' => $this->runsConceded,
            'wickets' => $this->wickets,
            'maidens' => $this->maidens,
            'no_balls' => $this->noBalls,
            'wides' => $this->wides,
        ]);

        $this->resetBowlerInputFields();
        $this->loadData();
    }

    public function editBowlerPerformance($id)
    {
        $performance = BowlerPerformance::findOrFail($id);
        $this->bowlerPerformanceId = $id;
        $this->bowlerId = $performance->bowler_id;
        $this->oversBowled = $performance->overs_bowled;
        $this->runsConceded = $performance->runs_conceded;
        $this->wickets = $performance->wickets;
        $this->maidens = $performance->maidens;
        $this->noBalls = $performance->no_balls;
        $this->wides = $performance->wides;
    }

    public function deleteBowlerPerformance($id)
    {
        BowlerPerformance::findOrFail($id)->delete();
        $this->loadData();
    }

    public function resetBowlerInputFields()
    {
        $this->bowlerPerformanceId = null;
        $this->bowlerId = null;
        $this->oversBowled = null;
        $this->runsConceded = null;
        $this->wickets = null;
        $this->maidens = null;
        $this->noBalls = null;
        $this->wides = null;
    }

    public function render()
    {
        $players = Player::all();
        return view('livewire.manage-match-performance', compact('players'));
    }
}
