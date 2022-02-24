<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{
    public $search = "";
    public $modalTitle;
    public $deleteId = '';
    public Category $editing;

    public function rules()
    {
        return [
            'editing.name' => 'required|unique:categories,name'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankCategory();
    }

    public function makeBlankCategory()
    {
        return  $this->editing = Category::make();
    }

    public function render()
    {
        $categories = Category::search($this->search)->orderBy('name')->get();
        return view('livewire.category-component', ['categories' => $categories]);
    }

    public function edit(Category $category)
    {
        if ($this->editing->isNot($category)) $this->editing = $category;
        $this->modalTitle = "Edit category";
        $this->emit('modalOpen');
    }

    public function create()
    {
        $this->editing = $this->makeBlankCategory(); //cleaning modal fields
        $this->modalTitle = "New category";
        $this->emit('modalOpen');
    }

    public function save()
    {
        $this->validate($this->rules(), $this->messages());
        $this->editing->save();
        $this->emit('modalSave'); // Close modal using jquery in layout
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        Category::findOrFail($this->deleteId)->delete();
        $this->deleteId = "";
        $this->editing = $this->makeBlankCategory(); //refreshing
    }
}
