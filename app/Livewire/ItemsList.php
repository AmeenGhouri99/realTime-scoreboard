<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;

class ItemsList extends Component
{
    public $items;

    protected $listeners = ['refreshItems' => 'fetchItems'];

    public function mount()
    {
        $this->fetchItems();
    }

    public function fetchItems()
    {
        $this->items = Item::latest()->get();
    }

    public function render()
    {
        return view('livewire.items-list');
    }
}
