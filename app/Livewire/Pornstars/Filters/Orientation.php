<?php

namespace App\Livewire\Pornstars\Filters;

use Livewire\Component;

class Orientation extends Component
{
    public $orientations;
    public $selectedOrientation;

    public function updatedSelectedOrientation()
    {
        $this->dispatch('filters-changed', ["orientation" => $this->selectedOrientation]);
    }

    public function mount()
    {
        $this->orientations = \App\Models\Orientation::all();   
    }
    public function render()
    {
        return view('livewire.pornstars.filters.orientation');
    }
}
