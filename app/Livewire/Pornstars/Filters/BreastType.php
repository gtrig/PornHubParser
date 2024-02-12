<?php

namespace App\Livewire\Pornstars\Filters;

use Livewire\Component;

class BreastType extends Component
{
    public $breastTypes;
    public $selectedBreastType;

    public function mount()
    {
        $this->breastTypes = \App\Models\BreastType::all();
    }

    public function updatedSelectedBreastType()
    {
        $this->dispatch('filters-changed', ["breastType" => $this->selectedBreastType]);
    }

    public function render()
    {
        return view('livewire.pornstars.filters.breast-type');
    }
}
