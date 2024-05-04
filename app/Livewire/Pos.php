<?php

namespace App\Livewire;
use App\Models\category as ModelsCategory;
use App\Models\product as Modelsproduct;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Pos extends Component
{
    public $selectedCategory;
    public $cartItems = [];
    public $totalPrice = 0;

        public function addToCart($productId)
    {
        // Check if the product already exists in the cart
        $index = array_search($productId, array_column($this->cartItems, 'id'));

        if ($index !== false) {
            // If the product exists, increment its quantity
            $this->cartItems[$index]['quantity']++;
        } else {
            // If the product doesn't exist, add it to the cart with quantity 1
            $product = Modelsproduct::findOrFail($productId);
            $this->cartItems[] = [
                'id' => $productId,
                'quantity' => 1,
                'name' => $product->name,
                'price' => $product->price // Add price to the cart item
            ];
        }
    }
    // Method to increase the quantity of an item in the cart
    public function increaseQuantity($productId)
    {
        $index = array_search($productId, array_column($this->cartItems, 'id'));
        if ($index !== false) {
            $this->cartItems[$index]['quantity']++;
        }
    }

    // Method to decrease the quantity of an item in the cart
    public function decreaseQuantity($productId)
    {
        $index = array_search($productId, array_column($this->cartItems, 'id'));
        if ($index !== false && $this->cartItems[$index]['quantity'] > 1) {
            $this->cartItems[$index]['quantity']--;
        }
    }



    public function render()
    {
        $category = ModelsCategory::where('status', 1)->get();

        // Fetch products using raw SQL query
        $products = [];
        if ($this->selectedCategory) {
            $products = DB::select("SELECT * FROM products WHERE category_id = :category_id AND status = 1", ['category_id' => $this->selectedCategory]);
        } else {
            // If no category is selected, fetch all active products
            $products = Modelsproduct::where('status', 1)->get();
        }

        return view('livewire.pos',compact('category','products'));
    }
}
