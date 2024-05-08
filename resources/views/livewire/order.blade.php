<div>
    {{-- In work, do what you enjoy. --}}
    <!-- resources/views/livewire/order-list.blade.php -->

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border-b border-gray-200 text-gray-600 font-bold uppercase text-sm">
                        Order ID</th>
                    <th class="px-4 py-2 bg-gray-100 border-b border-gray-200 text-gray-600 font-bold uppercase text-sm">
                        Product Names</th>
                    <th class="px-4 py-2 bg-gray-100 border-b border-gray-200 text-gray-600 font-bold uppercase text-sm">
                        Total Quantity</th>
                    <th class="px-4 py-2 bg-gray-100 border-b border-gray-200 text-gray-600 font-bold uppercase text-sm">
                        Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $order->id }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $order->product_names }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $order->total_quantity }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $order->total_price }} TK</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



</div>
