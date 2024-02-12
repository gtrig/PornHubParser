<?php

namespace App\Livewire\Pornstars\Filters;

use Livewire\Component;

class Age extends Component
{
    public $ageFrom=null;
    public $ageTo=null;

    public function updatedAgeFrom($value)
    {
        $this->dispatch('filters-changed', ["ageFrom" => $this->ageFrom]);
    }

    public function updatedAgeTo($value)
    {
        $this->dispatch('filters-changed', ["ageTo" => $this->ageTo]);
    }

    public function render()
    {
        return view('livewire.pornstars.filters.age');
    }
}
