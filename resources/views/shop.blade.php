@extends('layouts.app')

<style>
    .row {
        margin: 0;
    }

    .under_main_summer {
        border: 1px solid #ddd;
    }

    .imageBox {
        position: relative;
        overflow: hidden;
    }

    .img1 {
        height: 200px;
        object-fit: cover;
        width: 100%;
        transition: opacity 0.3s;
    }

    .icon_main_under {
        display: flex;
        justify-content: center;
        gap: 10px;
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .imageBox:hover .icon_main_under {
        opacity: 1;
    }

    .txt_under_bottom {
        text-align: center;
    }

    .imageBox:hover .img1 {
        opacity: 0.5;
    }

    .modal-img {
        width: 100%;
        height: auto;
        transition: transform 0.3s;
    }

    .modal-img:hover {
        transform: scale(1.2);
    }

    .modal-dialog {
        max-width: 800px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        margin: 10px 0;
    }

    .quantity-controls input {
        width: 50px;
        text-align: center;
    }

    .add-to-cart {
        margin-top: 10px;
    }
</style>

@section('content')
<section class="shop-sec-main">
    <div class="container">
        <div class="page-back">
            <p><a href="#">Home</a> / Shop</p>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="product-categories-mainn">
                    <div class="d-flex product-categories align-items-start">
                        <form method="GET" action="{{ route('trendora.shop') }}" id="category-form">
                            <input type="hidden" name="category_id" id="category_id">
                            <h6>Product Categories</h6>
                            <div class="nav flex-column nav-pills me-3">
                                @foreach($data as $category)
                                <button type="button" class="nav-link" onclick="submitCategory({{ $category->id }})">
                                    {{ $category->title }}
                                </button>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="range-filter">
                        <label for="minPrice">Min Price:</label>
                        <input type="range" id="minPrice" name="minPrice" min="0" max="100" step="1" value="0" oninput="updatePriceValues()">
                        <span id="minPriceValue">0</span>

                        <label for="maxPrice">Max Price:</label>
                        <input type="range" id="maxPrice" name="maxPrice" min="0" max="100" step="1" value="100" oninput="updatePriceValues()">
                        <span id="maxPriceValue">100</span>
                    </div>

                    <p>Selected Range: <span id="rangeValue">0 - 100</span></p>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <section class="product-categories-nxt">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p id="productCount">Showing 1–{{ $product->count() }} of {{ $product->count() }} results</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="select-sort-by">
                                            <form method="GET" action="{{ route('trendora.shop') }}">
                                                <select name="sort_by" onchange="this.form.submit()">
                                                    <option value="">Select</option>
                                                    <option value="sort_by_latest" {{ request('sort_by') === 'sort_by_latest' ? 'selected' : '' }}>Sort by latest</option>
                                                    <option value="low_to_high" {{ request('sort_by') === 'low_to_high' ? 'selected' : '' }}>Sort by price: low to high</option>
                                                    <option value="high_to_low" {{ request('sort_by') === 'high_to_low' ? 'selected' : '' }}>Sort by price: high to low</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between" id="productList">
                                    @foreach($product as $item)
                                    <div class="col-lg-4 col-md-6 col-12 mb-4 product-item" data-price="{{ $item->price }}">
                                        <div class="under_main_summer">
                                            <div class="summer_insight">
                                                <div class="imageBox position-relative">
                                                    <div class="box" style="width:100%;">
                                                        @if($item->galleries->isNotEmpty())
                                                        <img class="img1" src="{{ asset('storage/' . $item->galleries[0]->photo) }}" alt="">
                                                        @else
                                                        <img class="img1" src="{{ asset('default_image.jpg') }}" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="icon_main_under">
                                                        <div class="flx_main_icon">
                                                            <i class="fa-solid fa-heart"></i>
                                                            <i class="fa-regular fa-eye" data-bs-toggle="modal" data-bs-target="#productModal-{{ $item->id }}"></i>
                                                            <i class="fa-solid fa-bag-shopping"></i>
                                                        </div>
                                                        @if($item->discount)
                                                        <span class="onsale">Sale</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt_under_bottom text-center">
                                                <h2>{{ $item->title }}</h2>
                                                @if($item->discount)
                                                <p>${{ number_format($item->price - ($item->price * $item->discount / 100), 2) }} <span>${{ number_format($item->price, 2) }}</span></p>
                                                @else
                                                <p>${{ number_format($item->price, 2) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product Modal -->
                                    <div class="modal fade" id="productModal-{{ $item->id }}" tabindex="-1" aria-labelledby="productModalLabel-{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="productModalLabel-{{ $item->id }}"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div id="modalCarousel-{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @foreach($item->galleries as $index => $gallery)
                                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                        <img class="modal-img" src="{{ asset('storage/' . $gallery->photo) }}" alt="" style="height:450px; width:100%;">
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                <button class="carousel-control-prev" type="button" data-bs-target="#modalCarousel-{{ $item->id }}" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button" data-bs-target="#modalCarousel-{{ $item->id }}" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h3>{{ $item->title }}</h3>
                                                            <p>{{ $item->description }}</p>
                                                            <div class="txt_under_bottom" style="text-align: left;">
                                                                @if($item->discount)
                                                                <p>${{ number_format($item->price - ($item->price * $item->discount / 100), 2) }} <span>${{ number_format($item->price, 2) }}</span></p>
                                                                @else
                                                                <p>${{ number_format($item->price, 2) }}</p>
                                                                @endif
                                                            </div>
                                                            <form action="{{ route('trendora.cart', $item->id) }}" method="POST">
                                                                @csrf
                                                                <div class="quantity-controls">
                                                                    <button type="button" onclick="decrementQuantity('{{ $item->id }}')">-</button>
                                                                    <input type="number" name="quantity" id="quantity-{{ $item->id }}" value="1" min="1">
                                                                    <button type="button" onclick="incrementQuantity('{{ $item->id }}')">+</button>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary add-to-cart">Add to Cart</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product Modal -->
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function submitCategory(categoryId) {
        document.getElementById('category_id').value = categoryId;
        document.getElementById('category-form').submit();
    }

    function updatePriceValues() {
        const minPrice = document.getElementById('minPrice').value;
        const maxPrice = document.getElementById('maxPrice').value;

        document.getElementById('minPriceValue').textContent = minPrice;
        document.getElementById('maxPriceValue').textContent = maxPrice;
        document.getElementById('rangeValue').textContent = `${minPrice} - ${maxPrice}`;

        filterProducts(minPrice, maxPrice);
    }

    function filterProducts(minPrice, maxPrice) {
        const products = document.querySelectorAll('.product-item');
        let count = 0;

        products.forEach(product => {
            const price = parseFloat(product.getAttribute('data-price'));

            if (price >= minPrice && price <= maxPrice) {
                product.style.display = 'block';
                count++;
            } else {
                product.style.display = 'none';
            }
        });

        document.getElementById('productCount').textContent = `Showing 1–${count} of ${count} results`;
    }

    function incrementQuantity(itemId) {
        const quantityInput = document.getElementById(`quantity-${itemId}`);
        quantityInput.value = parseInt(quantityInput.value) + 1;
    }

    function decrementQuantity(itemId) {
        const quantityInput = document.getElementById(`quantity-${itemId}`);
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    }
</script>
@endsection
