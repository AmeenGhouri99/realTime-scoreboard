<?php

namespace App\Livewire;

use App\Models\CricketMatch;
use Livewire\Component;
use App\Models\Match;
use App\Models\Team;

class MatchManagement extends Component
{
    public $matches, $team_1_id, $team_2_id, $winner_team_id, $match_date, $match_id;
    public $isModalOpen = false;

    public function render()
    {
        $this->matches = CricketMatch::all();
        return view('livewire.match-management', [
            'teams' => Team::all(),
        ]);
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
        $this->team_1_id = '';
        $this->team_2_id = '';
        $this->winner_team_id = null;
        $this->match_date = '';
        $this->match_id = '';
    }

    public function store()
    {
        $this->validate([
            'team_1_id' => 'required|exists:teams,id',
            'team_2_id' => 'required|exists:teams,id',
            'match_date' => 'nullable|date',
        ]);

        CricketMatch::updateOrCreate(['id' => $this->match_id], [
            'team_1_id' => $this->team_1_id,
            'team_2_id' => $this->team_2_id,
            'winner_team_id' => $this->winner_team_id,
            'date' => $this->match_date,
        ]);

        session()->flash('message', $this->match_id ? 'Match Updated Successfully.' : 'Match Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $match = CricketMatch::findOrFail($id);
        $this->match_id = $id;
        $this->team_1_id = $match->team_1_id;
        $this->team_2_id = $match->team_2_id;
        $this->winner_team_id = $match->winner_team_id;
        $this->match_date = $match->date;

        $this->openModal();
    }

    public function delete($id)
    {
        CricketMatch::find($id)->delete();
        session()->flash('message', 'Match Deleted Successfully.');
    }
}
