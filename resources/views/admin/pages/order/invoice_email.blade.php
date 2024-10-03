<!DOCTYPE html>
<html>
<head>
    <title>Your Invoice</title>
</head>
<body>
    <h1>Invoice for Order #{{ $order->order_number }}</h1>
    <p>Dear {{ $order->user->name ?? 'Customer' }},</p> <!-- Use a default value -->
    <p>Thank you for your order. Please find your invoice attached.</p>
    <p>Best Regards,<br>Your Company Name</p>
</body>
</html>
