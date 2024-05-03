<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\category as ModelsCategory;
use App\Models\product as Modelsproduct;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Product extends Component
{
    use WithFileUploads;

    public $name;
    public $image;
    public $price;
    public $quantity;
    public $category_id;

    // edit
    public $editid;
    public $editname;
    public $editprice;
    public $editquantity;
    public $editcategory_id;

    public function create(){
        // Validate the input fields
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required'],
        ]);

         // Upload the image and store its path
        $imagePath = $this->image->store('upload/product', 'public');

        // Create the product with the validated data
        Modelsproduct::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
            'category_id' => $validatedData['category_id'],
        ]);

         // Clear the input fields
        $this->reset(['name', 'image', 'price', 'quantity', 'category_id']);

         // Show a success message
        session()->flash('success', 'Product created successfully.');
    }

    public function delete($itemId){
        $item = Modelsproduct::findOrFail($itemId);
        $item->delete();

        session()->flash('success', 'Product deleted successfully.');
    }

    public function toggleStatus($productId)
    {
        $product = Modelsproduct::findOrFail($productId);
        $product->status = !$product->status;
        $product->save();
    }

    public function edit($itemId)
    {
        $item = Modelsproduct::findOrFail($itemId);
        $this->editid= $item->id;
        $this->editname = $item->name;
        $this->editprice = $item->price;
        $this->editquantity = $item->quantity;

    }

    public function update(){
        $validatedData = $this->validate([
            'editname' => ['required', 'string', 'min:3', 'max:255'],
            'editprice'=>['required', 'numeric', 'min:0'],
            'editquantity'=>['required', 'numeric', 'min:0']
        ]);

        // Find the product
        $product = Modelsproduct::findOrFail($this->editid);

        // Update the product with validated data
        $product->update([
            'name' => $validatedData['editname'],
            'price' => $validatedData['editprice'],
            'quantity' => $validatedData['editquantity'],
        ]);

        // Show success message
        session()->flash('success', 'Product updated successfully.');
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editid = null;
        $this->editname = null;
    }

    public function render()
    {
        $category = ModelsCategory::where('status', 1)->get();

        $products = Modelsproduct::with('category')->get();

        return view('livewire.product',compact('category','products'));
    }
}
