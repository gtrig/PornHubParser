<?php

namespace App\Livewire\Pornstars\Filters;

use Livewire\Component;

class Search extends Component
{
    public $search;

    public function updatedSearch()
    {
        $this->dispatch('filters-changed', ["search" => $this->search]);
    }

    public function render()
    {
        return view('livewire.pornstars.filters.search');
    }
}
