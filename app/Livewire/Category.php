<?php

namespace App\Livewire;

use App\Models\category as ModelsCategory;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Str;


class Category extends Component
{
    // validation rule
    #[Rule('required|min:3|max:50')]
    public $name;

    // edit items
    public $editingItemId;
    #[Rule('required|min:3|max:50')]
    public $editingName;

    public function create(){
        $validated = $this->validateOnly('name');
        // Generate slug from name
        $validated['slg'] = Str::slug($validated['name']);

        // Save the data in the database
        ModelsCategory::create($validated);

         // Clear the input field
        $this->reset('name');

         // Show alert message when data is saved
        session()->flash('success', 'Category created successfully.');
    }

    public function edit($itemId)
    {
        $item = ModelsCategory::findOrFail($itemId);
        $this->editingItemId = $item->id;
        $this->editingName = $item->name;
    }

    public function cancelEdit()
    {
        $this->editingItemId = null;
        $this->editingName = null;
    }

    public function update()
{
    // Validate input
    $validatedData = $this->validate([
        'editingName' => ['required', 'string', 'min:3', 'max:255'],
    ]);

    $item = ModelsCategory::findOrFail($this->editingItemId);
    $item->update(['name' => $validatedData['editingName']]);

    session()->flash('success', 'Category updated successfully.');
    $this->cancelEdit();
}


    public function toggleStatus($itemId)
    {
        $item = ModelsCategory::findOrFail($itemId);
        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();
    }

    public function delete($itemId)
    {
        $item = ModelsCategory::findOrFail($itemId);
        $item->delete();

        session()->flash('success', 'Category deleted successfully.');
    }

    public function render()
    {
        $category = ModelsCategory::latest()->paginate(3);
        return view('livewire.category',compact('category'));
    }
}
