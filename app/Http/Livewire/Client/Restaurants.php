<?php

namespace App\Http\Livewire\Client;

use App\Models\Restaurant;
use Livewire\Component;

class Restaurants extends Component
{
    public $search = "";

    public function render()
    {
        return view(
            'livewire.client.restaurants',
            ['restaurants' => Restaurant::search($this->search)->get()]
        );
    }
}
