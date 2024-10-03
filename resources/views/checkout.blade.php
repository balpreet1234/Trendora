@extends('layouts.app')

@section('content')
<section class="page-back_section">
    <div class="container">
        <div class="page-back_d">
            <p><a href="#">Home</a> / Cart</p>
        </div>
    </div>
</section>

<section class="check-billing-details py_8">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="checkout-billing-main checkout-bill-mainsss">
                    <div class="check-billing-heading">
                        <h3>Billing Details</h3>
                    </div>
                    <form action="{{ route('place.order') }}" method="POST" class="check-out-form-own-cn">
                        @csrf
                        <input type="hidden" name="sub_total" value="{{ $subtotal }}">
                        <input type="hidden" name="total_amount" value="{{ $total }}">
                        <input type="hidden" name="quantity" value="{{ $totalQuantity }}">
                        <input type="hidden" name="cart_id[]" value="{{ $cartIdsString }}">

                        <div class="cnt-pag-form">
                            <div class="flexform-main">
                                <div class="cnt-pag-form-main check-widthform">
                                    <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" >
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="cnt-pag-form-main check-widthform">
                                    <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" >
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="cnt-pag-form-main">
                                <input class="form-control" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" >
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="cnt-pag-form-main">
                                <input class="form-control" type="tel" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="cnt-pag-form-main">
                                <select class="form-control" id="country-select" name="country_id">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="cnt-pag-form-main">
                                <select class="form-control" id="state-select" name="state_id">
                                    <option value="">Select State</option>
                                </select>
                                @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="cnt-pag-form-main">
                                <select class="form-control" id="city-select" name="city_id">
                                    <option value="">Select City</option>
                                </select>
                                @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="cnt-pag-form-main">
                                <input class="form-control" type="text" name="address" placeholder="Address" value="{{ old('address') }}" >
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="cnt-pag-form-main">
                                <input class="form-control" type="text" name="apartment" placeholder="Apartment, suite, unit, etc. (Optional)" value="{{ old('apartment') }}">
                                @error('apartment')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="cnt-pag-form-main">
                                <input class="form-control" type="text" name="postcode" placeholder="PostCode/Zip" value="{{ old('postcode') }}" >
                                @error('postcode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="checkout-placeorder-button">
                            <div class="btn_home_banner">
                                <button type="submit" class="btn btn-primary">Place Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="checkout-billing-main">
                    <div class="check-billing-heading">
                        <h3>Your Order</h3>
                    </div>
                    <div class="checkout-product-table-mainn">
                        <table class="checkout-product-table">
                            <thead>
                                <tr class="checkout-product-dettail">
                                    <th>Product</th>
                                    <th class="price">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr class="checkout-product-dettail">
                                        <td>
                                            <div class="check-purchage-img">
                                                <div class="image_cart p-3">
                                                    <img src="{{ asset('storage/' . $item->product->galleries->first()->photo) }}" alt="{{ $item->product->title }}" class="img-fluid">
                                                    <span class="pe-2">{{ $item->product->title }} × {{ $item->quantity }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price">${{ $item->amount }}</td>
                                    </tr>
                                @endforeach
                                <tr class="checkout-product-dettail">
                                    <td>Subtotal</td>
                                    <td class="price">${{ number_format(collect($cartItems)->sum('amount'), 2) }}</td>
                                </tr>
                                <tr class="checkout-product-dettail" style="border: none;">
                                    <td>Total:</td>
                                    <td class="price">${{ number_format(collect($cartItems)->sum('amount'), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#country-select').on('change', function() {
            var countryId = $(this).val();
            if (countryId) {
                $.ajax({
                    url: '{{ route("search.states") }}',
                    method: 'GET',
                    data: { country_id: countryId },
                    success: function(data) {
                        $('#state-select').empty().append('<option value="">Select State</option>');
                        $.each(data, function(index, state) {
                            $('#state-select').append('<option value="' + state.id + '">' + state.name + '</option>');
                        });
                    }
                });
                $('#city-select').empty().append('<option value="">Select City</option>');
            } else {
                $('#state-select').empty().append('<option value="">Select State</option>');
                $('#city-select').empty().append('<option value="">Select City</option>');
            }
        });

        $('#state-select').on('change', function() {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    url: '{{ route("search.cities") }}',
                    method: 'GET',
                    data: { state_id: stateId },
                    success: function(data) {
                        $('#city-select').empty().append('<option value="">Select City</option>');
                        $.each(data, function(index, city) {
                            $('#city-select').append('<option value="' + city.id + '">' + city.name + '</option>');
                        });
                    }
                });
            } else {
                $('#city-select').empty().append('<option value="">Select City</option>');
            }
        });
    });
</script>
@endsection
