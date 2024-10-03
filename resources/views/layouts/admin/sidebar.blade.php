<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Trendora</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li><a href="{{ route('dashboard') }}"><i class="bi bi-arrow-right-short"></i>Dashboard</a></li>
            </ul>
        </li>

        <li class="menu-label">ECommerce</li>
        <li>
            <a href="{{ route('brand.list') }}">
                <div class="parent-icon"><i class="bi bi-award"></i></div>
                <div class="menu-title">Brand</div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-bag-check"></i></div>
                <div class="menu-title">Products</div>
            </a>
            <ul>
                <li><a href="{{ route('category.index') }}"><i class="bi bi-arrow-right-short"></i>Category</a></li>
                <li><a href="{{ route('product.list') }}"><i class="bi bi-arrow-right-short"></i>Products List</a></li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:void(0);">
                <div class="parent-icon"><i class="lni lni-offer"></i></div>
                <div class="menu-title">Coupons</div>
            </a>
            <ul>
                <li><a href="{{ route('coupons.index') }}"><i class="bi bi-arrow-right-short"></i>Coupon List</a></li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:void(0);">
                <div class="parent-icon"><i class="lni lni-delivery"></i></div>
                <div class="menu-title">Shipping</div>
            </a>
            <ul>
                <li><a href="{{ route('shippings.index') }}"><i class="bi bi-arrow-right-short"></i>Shipping List</a></li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:void(0);">
                <div class="parent-icon"><i class="bi bi-cloud-arrow-down"></i></div>
                <div class="menu-title">Orders</div>
            </a>
            <ul>
                <li><a href="{{ route('order.index') }}"><i class="bi bi-arrow-right-short"></i>Order List</a></li>
            </ul>
        </li>

        <li class="menu-label">Pages</li>

        @if(auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'merchant'))
            <li>
                <a href="javascript:void(0);" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-bag-check"></i></div>
                    <div class="menu-title">User Management</div>
                </a>
                <ul>
                    <li><a href="{{ route('user.index') }}"><i class="bi bi-arrow-right-short"></i>Users</a></li>
                    <li><a href="{{ route('seller.index') }}"><i class="bi bi-arrow-right-short"></i>Sellers</a></li>
                </ul>
            </li>
        @endif

        <li>
            <a href="{{ route('logout') }}">
                <div class="parent-icon"><i class="bi bi-credit-card-2-front"></i></div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
