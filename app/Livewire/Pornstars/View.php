<?php

namespace App\Livewire\Pornstars;

use App\Models\Pornstar;
use Livewire\Component;

class View extends Component
{
    public $pornstar;

    public function mount($name)
    {
        $this->pornstar = Pornstar::where('name', $name)->first();
    }

    public function render()
    {
        return view('livewire.pornstars.view')->title($this->pornstar->name);
    }
}
