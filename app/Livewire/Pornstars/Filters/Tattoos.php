<?php

namespace App\Livewire\Pornstars\Filters;

use Livewire\Component;

class Tattoos extends Component
{
    public $tattoos;

    public function updatedTattoos($value)
    {
        $this->dispatch('filters-changed', ['tattoos'=>$value]);
    }

    public function render()
    {
        return view('livewire.pornstars.filters.tattoos');
    }
}
