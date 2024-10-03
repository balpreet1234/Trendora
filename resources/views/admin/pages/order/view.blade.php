@extends('layouts.admin.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@section('content')

<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Order Details</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card-header py-3 bg-transparent">
        <div class="d-sm-flex align-items-center">
            <h5 class="mb-2 mb-sm-0">Order #{{ $order->order_number }}</h5>
            <div class="ms-auto">
                <a href="{{ route('order.index') }}" class="btn btn-secondary me-2">Back</a>
                <a href="{{ route('downloal-invoice', $order->id) }}" class="btn btn-primary">Download Invoice</a>
            </div>
        </div>
    </div>

    <section class="order-detail-section">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5>User Details</h5>
                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
                    <p><strong>Shipping Address:</strong> {{ $order->address1 }}, {{ $order->city }}, {{ $order->state }} - {{ $order->post_code }}</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h5>Order Summary</h5>
                    <p><strong>Subtotal:</strong> ${{ number_format($order->sub_total, 2) }}</p>
                    <p><strong>Delivery Fee:</strong> ${{ number_format($order->delivery_fee ?? 0, 2) }}</p>
                    <p><strong>Coupon Discount:</strong> ${{ number_format($order->coupon ?? 0, 2) }}</p>
                    <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                    <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                    <p><strong>Ordered on:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h5>Products in this Order</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($carts && count($carts) > 0)
                                @foreach($carts as $cartItem)
                                    <tr>
                                        <td>{{ $cartItem->product->title }}</td>
                                        <td>${{ number_format($cartItem->product->price, 2) }}</td>
                                        <td>{{ $cartItem->quantity }}</td>
                                        <td>${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No products found for this order.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
