<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Team;

class TeamComponent extends Component
{
    public $teams, $teamId, $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->teams = Team::all();
    }

    public function save()
    {
        $this->validate();
        Team::updateOrCreate(['id' => $this->teamId], ['name' => $this->name]);
        $this->resetInput();
        $this->emit('teamUpdated');
    }

    public function edit($id)
    {
        $team = Team::find($id);
        $this->teamId = $team->id;
        $this->name = $team->name;
        $this->emit('showModal', 'teamModal');
    }

    public function delete($id)
    {
        Team::find($id)->delete();
        $this->emit('teamUpdated');
    }

    private function resetInput()
    {
        $this->teamId = null;
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.team-component');
    }
}
