<?php

namespace App\Livewire\Pornstars;

use Livewire\Component;

class Filters extends Component
{
    public $showFilters = true;

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function render()
    {
        return view('livewire.pornstars.filters');
    }
}
