<?php

namespace App\Http\Livewire\Client;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;

    public $search = "";

    public function render()
    {
        // if ($this->search) {
        //     $categories = Category::search($this->search)->get();
        // } else {
        //     $categories = Category::search($this->search)->paginate(15);
        // }
        return view(
            'livewire.client.category-component',
            ['categories' => Category::search($this->search)->get()]
        );
    }
}
