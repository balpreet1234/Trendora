@extends('layouts.app')

@section('content')
<section class="page-back_section">
    <div class="container">
        <div class="page-back_d">
            <p><a href="#">Home</a> / Cart</p>
        </div>
    </div>
</section>

<!-- Cart Items section - start -->
<section class="cart_item-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12">
                <div class="heading_summer_Collection text-start cart_Items">
                    <h2>Cart Items</h2>
                </div>
                <form id="cart-update-form" action="{{ route('cart.updateAll') }}" method="POST">
                    @csrf
                    <div class="card_box" id="cart-items-container">
                        @foreach($data as $item)
                        <div class="row cart-item" data-item-id="{{ $item->id }}">
                            <div class="col-lg-2 col-4">
                                <div class="image_cart p-3">
                                    <img src="{{ asset('storage/' . $item->product->galleries->first()->photo) }}" alt="{{ $item->product->title }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-lg-4 col-4 p-2">
                                <div class="col-md-6 col-sm-12 product-name" data-title="Product">
                                    <a href="">{{ $item->product->title }}</a>
                                    <div class="product-price" data-title="Price">
                                        <span class="Price-amount amount"><bdi><span class="-Price-currencySymbol">$</span>{{ number_format($item->amount, 2) }}</bdi></span>
                                    </div>
                                    <div class="product-quantity" data-title="Quantity">
                                        <div class="quantity input-group">
                                            <input type="hidden" name="cart_items[{{ $item->id }}][id]" value="{{ $item->id }}">
                                            <input type="number" step="1" min="1" max="100" name="cart_items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}" title="Qty" class="input-text qty text form-control" inputmode="numeric">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-4 p-4">
                                <div class="main_box_subtotal">
                                    <div class="product-subtotal">
                                        <span class="price-amount amount">
                                            <span class="Price-currencySymbol">$</span>{{ number_format($item->amount, 2) }}
                                        </span>
                                    </div>
                                    <button type="button" class="btn btn-danger remove-item" data-item-id="{{ $item->id }}">Remove</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="apply_coupon">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="coupon">
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code">
                                    <button type="submit" class="button-Apply cart_update mt-2" name="apply_coupon" value="Apply coupon">Apply coupon</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="button_update">
                                    <button type="button" class="button cart_update" id="update_cart">Update cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12">
                <div class="heading_summer_Collection text-start cart_Items">
                    <h2>Cart totals</h2>
                </div>
                <div class="main_box_price-amount cart_Items">
                    <table cellspacing="0" class="shop_table shop_table_responsive">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td data-title="Subtotal">
                                    <span class="price-amount amount">
                                        <span class="Price-currencySymbol">$</span>{{ number_format($data->sum('amount'), 2) }}
                                    </span>
                                </td>
                            </tr>
                            <tr class="shipping-totals shipping">
                                <td>
                                    <p>Shipping</p>
                                    <label>Flat rate:
                                        <span class="price-currency">$ 10.00</span>
                                    </label>
                                    <p class="shipping-destination">
                                        Shipping options will be updated during checkout.
                                    </p>
                                    <form class="shipping-calculator">
                                        <a href="#" class="shipping-calculator-button">Calculate shipping</a>
                                    </form>
                                </td>
                            </tr>
                            <tr class="order-total cart-subtotal">
                                <th>Total</th>
                                <td data-title="Total"><strong>
                                    <span class="price-amount amount">
                                        <span class="Price-currencySymbol">$</span>{{ number_format($data->sum('amount') + 10.00, 2) }}
                                    </span>
                                </strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="proceed-to-checkout mt-3">
                        <a href="{{ route('cart.proceedToCheckout') }}" class="wc-forward" id="checkout-button">Proceed to checkout</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>

<!-- Checkout Confirmation Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Confirm Update Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You have updated the quantities in your cart. Please click 'Update Cart' to save changes before proceeding to checkout.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmUpdateCart">Update Cart</button>
            </div>
        </div>
    </div>
</div>

<script>
    let cartUpdated = false;

    document.querySelectorAll('input[name^="cart_items"]').forEach(function(input) {
        input.addEventListener('change', function() {
            cartUpdated = true;
        });
    });

    document.getElementById('checkout-button').addEventListener('click', function(event) {
        if (cartUpdated) {
            event.preventDefault();
            var checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
            checkoutModal.show();
        } else {
            window.location.href = '/checkout';
        }
    });

    document.getElementById('confirmUpdateCart').addEventListener('click', function() {
        document.getElementById('cart-update-form').submit();
    });

    document.getElementById('update_cart').addEventListener('click', function() {
        document.getElementById('cart-update-form').submit();
    });


document.querySelectorAll('.remove-item').forEach(function(button) {
    button.addEventListener('click', function(event) {
        const itemId = this.getAttribute('data-item-id');
        const row = this.closest('.cart-item');

        if (confirm('Are you sure you want to remove this item from your cart?')) {
            fetch(`{{ route('cart.destroy', '') }}/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
            })
            .then(response => {
                if (response.ok) {
                    row.remove();
                } else {
                    alert('Error removing item. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});

</script>

@endsection
