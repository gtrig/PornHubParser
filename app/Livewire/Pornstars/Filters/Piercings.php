<?php

namespace App\Livewire\Pornstars\Filters;

use Livewire\Component;

class Piercings extends Component
{
    public $piercings;

    public function updatedPiercings($value)
    {
        $this->dispatch('filters-changed', ['piercings'=>$value]);
    }

    public function render()
    {
        return view('livewire.pornstars.filters.piercings');
    }
}
