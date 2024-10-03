<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        h1 {
            text-align: center;
        }
        h2 {
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Invoice #{{ $order->order_number }}</h1>
    <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

    <h2>User Details</h2>
    <p><strong>Name:</strong> {{ optional($order->user)->name ?? 'N/A' }}</p>
    <p><strong>Email:</strong> {{ optional($order->user)->email ?? 'N/A' }}</p>
    <p><strong>Phone:</strong> {{ optional($order->user)->phone ?? 'N/A' }}</p>
    <p><strong>Shipping Address:</strong> {{ $order->address1 }}, {{ $order->city }}, {{ $order->state }} - {{ $order->post_code }}</p>

    <h2>Order Summary</h2>
    <p><strong>Subtotal:</strong> ${{ number_format($order->sub_total, 2) }}</p>
    <p><strong>Delivery Fee:</strong> ${{ number_format($order->delivery_fee, 2) }}</p>
    <p><strong>Coupon Discount:</strong> ${{ number_format($order->coupon ?? 0, 2) }}</p>
    <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>

    <h2>Products in this Order</h2>
    <table>
        <thead>
            <tr>
                <th>Product Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($carts as $cart)
                <tr>
                    <td>{{ $cart->product->title ?? 'Unknown Product' }}</td>
                    <td>${{ number_format($cart->product->price ?? 0, 2) }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>${{ number_format(($cart->product->price ?? 0) * $cart->quantity, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No products found in this order.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Thank you for your purchase!</p>
    </div>

</body>
</html>
