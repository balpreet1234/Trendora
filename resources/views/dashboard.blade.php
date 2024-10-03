@extends('layouts.admin.app')
@section('content')




<!--start content-->
<main class="page-content">

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Orders</p>
                            <h4 class="my-1">{{$orderCount}}</h4>
                            <p class="mb-0 font-13 text-success">
                                <i class="bi bi-caret-up-fill"></i> {{ number_format($orderChange, 2) }}% from last week
                            </p>
                        </div>
                        <div class="widget-icon-large bg-gradient-purple text-white ms-auto">
                            <i class="bi bi-basket2-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Products</p>
                            <h4 class="my-1">{{$totalProducts}}</h4>
                            <p class="mb-0 font-13 text-success">
                                <i class="bi bi-caret-up-fill"></i> {{ number_format($productChange, 2) }}% from last week
                            </p>
                        </div>
                        <div class="widget-icon-large bg-gradient-success text-white ms-auto">
                            <i class="bi bi-currency-exchange"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Customers</p>
                            <h4 class="my-1">{{$customer}}</h4>
                            <p class="mb-0 font-13 text-danger">
                                <i class="bi bi-caret-down-fill"></i> {{ number_format($customerChange, 2) }}% from last week
                            </p>
                        </div>
                        <div class="widget-icon-large bg-gradient-danger text-white ms-auto">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Brands</p>
                            <h4 class="my-1">{{$totalBrands}}</h4>
                            <p class="mb-0 font-13 text-success">
                                <i class="bi bi-caret-up-fill"></i> {{ number_format($brandChange, 2) }}% from last week
                            </p>
                        </div>
                        <div class="widget-icon-large bg-gradient-info text-white ms-auto">
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
    <div class="card radius-10">
        <div class="card-header bg-transparent">
            <div class="row g-3 align-items-center">
                <div class="col">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                        <div class="dropdown">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentOrders as $order)
                            <tr>
                                <td>#{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">

                                        <div class="product-info">
                                            @if($carts && count($carts) > 0)
                                @foreach($carts as $cartItem)
                                    <tr>
                                        <td>{{ $cartItem->product->title }}</td>

                                        <td>{{ $cartItem->quantity }}</td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No products found for this order.</td>
                                </tr>
                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ number_format($order->price, 2) }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3 fs-6">
                                        <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View detail" aria-label="Views">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit info" aria-label="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" aria-label="Delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</main>
<!--end page main-->



@endsection
