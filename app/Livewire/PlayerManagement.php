<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\Team;

class PlayerManagement extends Component
{
    public $players, $name, $role, $team_id, $player_id, $position;
    public $isModalOpen = false;

    public function render()
    {
        $this->players = Player::all();
        return view('livewire.player-management', [
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
        $this->name = '';
        $this->position = '';
        $this->team_id = '';
        $this->player_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'position' => 'required',
            'team_id' => 'required|exists:teams,id',
        ]);

        Player::updateOrCreate(['id' => $this->player_id], [
            'name' => $this->name,
            'position' => $this->position,
            'team_id' => $this->team_id,
        ]);

        session()->flash('message', $this->player_id ? 'Player Updated Successfully.' : 'Player Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $player = Player::findOrFail($id);
        $this->player_id = $id;
        $this->name = $player->name;
        $this->position = $player->position;
        $this->team_id = $player->team_id;

        $this->openModal();
    }

    public function delete($id)
    {
        Player::find($id)->delete();
        session()->flash('message', 'Player Deleted Successfully.');
    }
}
