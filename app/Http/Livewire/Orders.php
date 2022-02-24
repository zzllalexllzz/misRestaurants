<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Orders extends Component
{

    public $restaurant;

    public function mount($restaurant)
    {
        $this->restaurant = $restaurant;
    }

    public function render()
    {
        return view('livewire.orders');
    }
}
