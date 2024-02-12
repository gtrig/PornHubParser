<?php

namespace App\Livewire\Pornstars\Filters;

use Livewire\Component;

class HairColor extends Component
{
    public $hairColors;
    public $selectedHairColor;

    public function updatedSelectedHairColor()
    {
        $this->dispatch('filters-changed', ["hairColor" => $this->selectedHairColor]);
    }

    public function mount()
    {
        $this->hairColors = \App\Models\HairColor::all();
    }

    public function render()
    {
        return view('livewire.pornstars.filters.hair-color');
    }
}
