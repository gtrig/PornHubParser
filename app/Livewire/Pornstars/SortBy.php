<?php

namespace App\Livewire\Pornstars;

use Livewire\Component;

class SortBy extends Component
{
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $availableSorts = [
        'none' => 'None',
        'name' => 'Name',
        'age' => 'Age',
        'stats.rank' => 'Rank',
        'stats.subscriptions' => 'Subscribers',
        'stats.monthlySearches' => 'Searches',
        'stats.views' => 'Views',
    ];

    public function updatedSortBy($value)
    {
        $this->dispatch('sortBy', $this->sortBy, $this->sortDirection);
    }

    public function updatedSortDirection($value)
    {
        $this->dispatch('sortBy', $this->sortBy, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.pornstars.sort-by');
    }
}
