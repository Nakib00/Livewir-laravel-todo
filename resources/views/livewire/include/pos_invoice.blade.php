<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Invoice</title>
    <style>
        /* Add your CSS styles for the invoice here */
        /* For example: */
        .invoice-container {
            font-family: Arial, sans-serif;
            width: 100%;
            margin: 20px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-items th,
        .invoice-items td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .invoice-total {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>POS Invoice</h2>
        </div>
        <div class="invoice-details">
            <p><strong>Order ID:</strong> {{ $invoiceData['order_id'] }}</p>
        </div>
        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoiceData['items'] as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>{{ $item['quantity'] * $item['price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="invoice-total">
            <p><strong>Total Price:</strong> {{ $invoiceData['total_price'] }}</p>
        </div>
    </div>
</body>

</html>
