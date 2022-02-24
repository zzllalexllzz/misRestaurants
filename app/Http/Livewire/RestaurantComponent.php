<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

class RestaurantComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modalTitle;
    public $search = "";
    public $sortField = "name";
    public $sortDirection = 'asc';
    public $upload;
    public $deleteId = '';
    public Restaurant $editing;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['sortField', 'sortDirection'];

    public function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.address' => 'required',
            'editing.city' => 'required',
            'editing.phone' => 'required',
            'editing.email' => 'required|email:rfc,filter',
            'editing.latitude' => 'required|numeric',
            'editing.longitude' => 'required|numeric',
            'editing.user_id' => 'numeric',
            'upload' => 'image|nullable'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute must be a valid email address.',
            'numeric' => 'The :attribute must be a number.',
            'image' => 'The :attribute must be an image.',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankRestaurant();
    }

    public function makeBlankRestaurant()
    {
        return  $this->editing = Restaurant::make(['user_id' => Auth::id()]);
    }

    public function render()
    {
        if (Auth::user()->role->name == "Administrator") {
            $restaurants = Restaurant::search($this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        } else {
            $restaurants = Restaurant::where('user_id', '=', Auth::id())->search($this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }
        return view('livewire.restaurant-component', [
            'restaurants' => $restaurants
        ]);
    }

    public function edit(Restaurant $restaurant)
    {
        if ($this->editing->isNot($restaurant)) $this->editing = $restaurant;

        $this->modalTitle = "Edit restaurant";
        $this->emit('modalOpen');
    }

    public function create()
    {
        $this->editing = $this->makeBlankRestaurant(); //cleaning modal fields
        $this->modalTitle = "New restaurant";
        $this->emit('modalOpen');
    }

    public function save()
    {
        $this->validate($this->rules(), $this->messages());
        $this->editing->save();

        $this->upload && $this->editing->update([
            'photo_path' => Storage::disk('s3')->put('restaurants', $this->upload)
        ]);

        $this->emit('modalSave'); // Close modal using jquery in layout
    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        Restaurant::findOrFail($this->deleteId)->delete();
        $this->deleteId = "";
        $this->editing = $this->makeBlankRestaurant(); //refreshing
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
