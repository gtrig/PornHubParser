<?php

namespace App\Livewire\Pornstars\Filters;

use Livewire\Component;

class Gender extends Component
{
    public $genders = [];
    public $selectedGender;

    public function mount()
    {
        $this->genders = \App\Models\Gender::all();
    }

    public function updatedSelectedGender($value)
    {
        $this->dispatch('filters-changed', ['gender' => $value]);
    }

    public function render()
    {
        return view('livewire.pornstars.filters.gender');
    }
}
