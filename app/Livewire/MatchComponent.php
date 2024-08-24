<?php

namespace App\Livewire;

use App\Models\CricketMatch;
use Livewire\Component;
use App\Models\Match;
use App\Models\Team;

class MatchComponent extends Component
{
    public $matches, $matchId, $team1_id, $team2_id, $date, $location, $toss_winner_team_id, $decision, $batting_team_id, $bowling_team_id;

    public function mount()
    {
        $this->matches = CricketMatch::all();
    }

    public function save()
    {
        $this->validate();
        CricketMatch::updateOrCreate(['id' => $this->matchId], [
            'team_1_id' => $this->team1_id,
            'team_2_id' => $this->team2_id,
            'date' => $this->date,
            'location' => $this->location,
            'toss_winner_team_id' => $this->toss_winner_team_id,
            'decision' => $this->decision,
            'batting_team_id' => $this->batting_team_id,
            'bowling_team_id' => $this->bowling_team_id,
        ]);
        $this->resetInput();
        $this->emit('matchUpdated');
    }

    public function edit($id)
    {
        $match = CricketMatch::find($id);
        $this->matchId = $match->id;
        $this->team1_id = $match->team_1_id;
        $this->team2_id = $match->team_2_id;
        $this->date = $match->date;
        $this->location = $match->location;
        $this->toss_winner_team_id = $match->toss_winner_team_id;
        $this->decision = $match->decision;
        $this->batting_team_id = $match->batting_team_id;
        $this->bowling_team_id = $match->bowling_team_id;
        $this->emit('showModal', 'matchModal');
    }

    public function delete($id)
    {
        CricketMatch::find($id)->delete();
        $this->emit('matchUpdated');
    }

    private function resetInput()
    {
        $this->matchId = null;
        $this->team1_id = '';
        $this->team2_id = '';
        $this->date = '';
        $this->location = '';
        $this->toss_winner_team_id = '';
        $this->decision = '';
        $this->batting_team_id = '';
        $this->bowling_team_id = '';
    }

    public function render()
    {
        $teams = Team::all();
        return view('livewire.match-component', compact('teams'));
    }
}
