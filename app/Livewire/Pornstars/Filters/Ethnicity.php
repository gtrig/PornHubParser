<?php

namespace App\Livewire\Pornstars\Filters;

use Livewire\Component;

class Ethnicity extends Component
{
    public $ethnicities;
    public $selectedEthnicity;
    
    public function mount()
    {
        $this->ethnicities = \App\Models\Ethnicity::all();
    }

    public function updatingSelectedEthnicity($value)
    {
        $this->dispatch('filters-changed', ['ethnicity' => $value]);
    }

    public function render()
    {
        return view('livewire.pornstars.filters.ethnicity');
    }
}
