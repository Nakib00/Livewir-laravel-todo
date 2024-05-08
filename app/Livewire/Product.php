<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\category as ModelsCategory;
use App\Models\product as Modelsproduct;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\DB;

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

    public function create()
    {
        // Validate the input fields
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required'],
        ]);

        try {
            // Upload the image and store its path
            $imagePath = $this->image->store('upload/product', 'public');

            // Execute raw SQL query to create the product
            DB::insert('INSERT INTO products (name, image, price, quantity, category_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)', [
                $validatedData['name'],
                $imagePath,
                $validatedData['price'],
                $validatedData['quantity'],
                $validatedData['category_id'],
                now(), // current timestamp for created_at
                now(), // current timestamp for updated_at
            ]);

            // Clear the input fields
            $this->reset(['name', 'image', 'price', 'quantity', 'category_id']);

            // Show a success message
            session()->flash('success', 'Product created successfully.');
        } catch (\Exception $e) {
            // Handle exception if any
            session()->flash('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    public function delete($itemId)
    {
        try {
            // Execute raw SQL query to delete the product
            DB::delete('DELETE FROM products WHERE id = ?', [$itemId]);

            // Show success message
            session()->flash('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            // Handle exception if any
            session()->flash('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    public function toggleStatus($productId)
    {
        try {
            // Fetch the product's current status
            $currentStatus = DB::selectOne('SELECT status FROM products WHERE id = ?', [$productId])->status;

            // Toggle the status
            $newStatus = !$currentStatus;

            // Update the status using raw SQL query
            DB::update('UPDATE products SET status = ?, updated_at = ? WHERE id = ?', [
                $newStatus,
                now(), // current timestamp for updated_at
                $productId
            ]);

            // Show success message
            session()->flash('success', 'Product status toggled successfully.');
        } catch (\Exception $e) {
            // Handle exception if any
            session()->flash('error', 'Failed to toggle product status: ' . $e->getMessage());
        }
    }

    public function edit($itemId)
    {
        try {
            // Fetch the product using raw SQL query
            $item = DB::selectOne('SELECT * FROM products WHERE id = ?', [$itemId]);

            if (!$item) {
                throw new \Exception("Product not found");
            }

            // Set the product data
            $this->editid = $item->id;
            $this->editname = $item->name;
            $this->editprice = $item->price;
            $this->editquantity = $item->quantity;
        } catch (\Exception $e) {
            // Handle exception if any
            session()->flash('error', $e->getMessage());
        }
    }

    public function update()
    {
        // Validate input
        $validatedData = $this->validate([
            'editname' => ['required', 'string', 'min:3', 'max:255'],
            'editprice' => ['required', 'numeric', 'min:0'],
            'editquantity' => ['required', 'numeric', 'min:0']
        ]);

        try {
            // Execute raw SQL query to update the product
            DB::update('UPDATE products SET name = ?, price = ?, quantity = ?, updated_at = ? WHERE id = ?', [
                $validatedData['editname'],
                $validatedData['editprice'],
                $validatedData['editquantity'],
                now(), // current timestamp for updated_at
                $this->editid
            ]);

            // Show success message
            session()->flash('success', 'Product updated successfully.');

            // Reset editing state
            $this->cancelEdit();
        } catch (\Exception $e) {
            // Handle exception if any
            session()->flash('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    public function cancelEdit()
    {
        $this->editid = null;
        $this->editname = null;
    }

    public function render()
    {
        // Fetch active categories
        $categories = DB::table('categories')->where('status', 1)->get();

        // Fetch products along with their categories where the category status is active
        $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('categories.status', 1)
        ->select('products.*', 'categories.name as category_name')
        ->get();


        return view('livewire.product', compact('categories', 'products'));
    }
}
