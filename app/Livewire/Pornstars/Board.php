<?php

namespace App\Livewire\Pornstars;

use App\Models\HairColor;
use App\Models\Pornstar;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Board extends Component
{
    use WithPagination;

    public $perPage = 24;
    public $hairColors;
    public $sortBy = 'none';
    public $sortDirection = 'asc';
    public $filters = [
        'search' => '',
        'ageFrom' => null,
        'ageTo' => null,
        'orientation' => 'All',
        'ethnicity' => 'All',
        'breast_size' => 'All',
        'breastType' => 'All',
        'piercings' => 'All',
        'tattoos' => 'All',
        'hairColor' => 'All',
    ];

    public function mount()
    {
        $this->hairColors = HairColor::all();
    }

    #[On('filters-changed')]
    public function handleFilterChanged($filter)
    {
        $this->filters = array_merge($this->filters, $filter);
        $this->resetPage();
    }

    #[On('sortBy')]
    public function handleSortBy($sortBy, $sortDirection)
    {
        $this->sortBy = $sortBy;
        $this->sortDirection = $sortDirection;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getPornstars()
    {
        $p = Pornstar::query();

        if($this->sortBy != 'none') {
            $p->join('stats', 'pornstars.id', '=', 'stats.pornstar_id');
            $p->where($this->sortBy, '!=', 0);
            $p->orderBy($this->sortBy, $this->sortDirection);
        }

        if($this->filters['search'] != '') {
            $p->where('name', 'like', '%'.$this->filters['search'].'%');
        }

        if($this->filters['ageFrom'] != null && $this->filters['ageTo'] != null) {
            $p->whereBetween('age', [$this->filters['ageFrom'],$this->filters['ageTo']]);
        }

        if($this->filters['ageFrom'] != null && $this->filters['ageTo'] == null) {
            $p->where('age', '>=', [$this->filters['ageFrom']]);
        }

        if($this->filters['ageFrom'] == null && $this->filters['ageTo'] != null) {
            $p->where('age', '<=', [$this->filters['ageTo']]);
        }

        if($this->filters['orientation'] != 'All') {
            $p->whereHas('orientation', function($q) {
                $q->where('id', $this->filters['orientation']);
            });
        }

        //hair color
        if($this->filters['hairColor'] != 'All') {
            $p->whereHas('hairColor', function($q) {
                $q->where('id', $this->filters['hairColor']);
            });
        }

        //ethnicity
        if($this->filters['ethnicity'] != 'All') {
            $p->whereHas('ethnicity', function($q) {
                $q->where('id', $this->filters['ethnicity']);
            });
        }


        if($this->filters['breastType'] != 'All') {
            $p->whereHas('breastType', function($q) {
                $q->where('id', $this->filters['breastType']);
            });
        }

        if($this->filters['piercings'] != 'All')
        {
            $p->where('piercings',$this->filters['piercings']);
        }

        if($this->filters['tattoos'] != 'All')
        {
            $p->where('tattoos',$this->filters['tattoos']);
        }

        

        return $p;
    }

    public function render()
    {
        return view('livewire.pornstars.board',
            [
                'pornstars' => $this->getPornstars()->paginate($this->perPage)
            ]
        )->title('Pornstars');
    }
}
