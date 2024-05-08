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
                'price' => $product->price,
                'image' => $product->image
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

    // Method to remove an item from the cart
    public function removeFromCart($productId)
    {
        // Find the index of the item in the cart
        $index = array_search($productId, array_column($this->cartItems, 'id'));

        // If the item is found, remove it from the cart
        if ($index !== false) {
            // Update the total price before unsetting the item
            $this->totalPrice -= $this->cartItems[$index]['quantity'] * $this->cartItems[$index]['price'];

            unset($this->cartItems[$index]);
        }

        // Trigger Livewire's render method to update the UI
        $this->render();
    }

    // Method to calculate total price
    public function calculateTotalPrice()
    {
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        $this->totalPrice = $total;
    }

    // Order save
    public function saveOrder(){

        // Check if the cart is empty
    if (empty($this->cartItems)) {
        // If the cart is empty, display an alert
        session()->flash('error', 'Cannot print. Cart is empty!');
        return;
    }

        // First, create a new order record
        $order = DB::table('orders')->insertGetId([
            'order_id' => uniqid(), // Generate a unique order ID
            'total_amount' => $this->totalPrice,
            'status' => 'pending', // You can set the initial status as 'pending'
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Next, loop through the cart items and insert them into the order_items table
        foreach ($this->cartItems as $item) {
            DB::table('order_items')->insert([
                'order_id' => $order,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']*$item['quantity'],
                'created_at' => now(),
            ]);
        }

        // Clear the cart after saving the order
        $this->cartItems = [];

        // Optionally, you can redirect the user to a confirmation page or display a success message
        session()->flash('success', 'Order saved successfully!');
    }


    public function render()
{
    $category = DB::select("
        SELECT *
        FROM categories
        WHERE status = 1
    ");

    // Fetch products using raw SQL query
    $products = [];
    if ($this->selectedCategory) {
        $products = DB::select("
            SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            WHERE products.category_id = :category_id AND products.status = 1
        ", ['category_id' => $this->selectedCategory]);
    } else {
        // If no category is selected, fetch all active products along with their category name
        $products = DB::select("
            SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            WHERE products.status = 1
        ");
    }

    // Calculate total price
    $this->calculateTotalPrice();

    return view('livewire.pos', compact('category', 'products'));
}

}
