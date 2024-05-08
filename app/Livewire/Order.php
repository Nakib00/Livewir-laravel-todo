<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Order extends Component
{
    public function render()
    {
        // Fetch orders and related order items from the database using raw SQL
    $orders = DB::select("
    SELECT orders.id, GROUP_CONCAT(products.name) AS product_names, SUM(order_items.quantity) AS total_quantity, SUM(order_items.price * order_items.quantity) AS total_price
        FROM orders
        JOIN order_items ON orders.id = order_items.order_id
        JOIN products ON order_items.product_id = products.id
        GROUP BY orders.id
");

        return view('livewire.order',compact('orders'));
    }
}
