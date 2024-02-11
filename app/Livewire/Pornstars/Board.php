<?php

namespace App\Livewire\Pornstars;

use App\Models\Pornstar;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Board extends Component
{

    #[Computed()]
    public function getPornstarsProperty()
    {
        $pornstars = Pornstar::query();
        return $pornstars->paginate(32);
    }

    public function render()
    {
        return view('livewire.pornstars.board');
    }
}
