<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Team;

class TeamManagement extends Component
{
    public $teams, $name, $team_id;
    public $isModalOpen = false;

    public function render()
    {
        $this->teams = Team::all();
        return view('livewire.team-management');
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

    private function resetInputFields()
    {
        $this->name = '';
        $this->team_id = '';
    }

    public function store()
    {
        // dd($this->name);
        $this->validate([
            'name' => 'required',
        ]);

        Team::updateOrCreate(['id' => $this->team_id], [
            'name' => $this->name,
        ]);

        session()->flash('message', $this->team_id ? 'Team Updated Successfully.' : 'Team Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $this->team_id = $id;
        $this->name = $team->name;

        $this->openModal();
    }

    public function delete($id)
    {
        Team::find($id)->delete();
        session()->flash('message', 'Team Deleted Successfully.');
    }
}
