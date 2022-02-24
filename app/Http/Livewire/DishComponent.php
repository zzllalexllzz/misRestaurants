<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Dish;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DishComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modalTitle;
    public $restaurantId;
    public $search = "";
    public $category = "";
    public $sortField = "name";
    public $sortDirection = 'asc';
    public $upload;
    public $deleteId = '';
    public Dish $editing;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['sortField', 'sortDirection'];

    public function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.category_id' => 'required',
            'editing.restaurant_id' => 'required',
            'editing.price' => 'required|numeric',
            'editing.description' => 'string|nullable',
            'upload' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute must be a number.',
            'string' => 'The :attribute must be a string.',
            'image' => 'The :attribute must be an image.',
        ];
    }

    public function mount($restaurant)
    {
        $this->restaurantId = $restaurant->id;
        $this->editing = $this->makeBlankDish();
    }

    public function makeBlankDish()
    {
        return  $this->editing = Dish::make([
            'restaurant_id' => $this->restaurantId,
            'category_id' => Category::first()->id // important to put one by default
        ]);
    }

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->category . '%')->get();

        $dishes = Dish::where('restaurant_id', $this->restaurantId)
            ->search($this->search)->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
        return view('livewire.dish-component', ['dishes' => $dishes, 'categories' => $categories]);
    }

    public function edit(Dish $dish)
    {
        if ($this->editing->isNot($dish)) $this->editing = $dish;
        $this->category = $dish->getCategory->name;
        $this->modalTitle = "Edit dish";
        $this->emit('modalOpen');
    }

    public function create()
    {
        // Initializing editing object and cleaning modal fields
        // if ($this->editing->getKey()) {
        $this->editing = $this->makeBlankDish();
        $this->upload = "";
        $this->category = "";
        // }

        $this->modalTitle = "New dish";
        $this->emit('modalOpen');
    }

    public function save()
    {
        $this->validate($this->rules(), $this->messages());
        $this->editing->save();

        $this->upload && $this->editing->update([
            'photo_path' => Storage::disk('s3')->put('dishes', $this->upload)
        ]);

        $this->emit('modalSave'); // Close model using jquery in layout
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        Dish::findOrFail($this->deleteId)->delete();
        $this->deleteId = "";
        $this->editing = $this->makeBlankDish(); //refreshing
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }
}
