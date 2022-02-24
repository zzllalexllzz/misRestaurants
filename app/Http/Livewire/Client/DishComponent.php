<?php

namespace App\Http\Livewire\Client;

use App\Models\Category;
use App\Models\Dish;
use Livewire\Component;

class DishComponent extends Component
{
    public $restaurant;
    public $dishes;
    public $clearSearch = false;

    public function mount($restaurant)
    {
        $this->restaurant = $restaurant;
        $this->dishes = $this->restaurant->getDishes;
    }
    public function render()
    {

        return view(
            'livewire.client.dish-component',
            ['dishes' => $this->dishes]
        );
    }

    public function filter($categoryId = "")
    {
        if ($categoryId) {
            $this->dishes = $this->restaurant->getDishes->where('category_id', $categoryId);
            $this->clearSearch = true;
        } else {
            $this->dishes = $this->restaurant->getDishes;
            $this->clearSearch = false;
        }
    }
}
