@extends('layouts.admin.app')

@section('content')

<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipping</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card-header py-3 bg-transparent">
                <div class="d-sm-flex align-items-center">
                    <h5 class="mb-2 mb-sm-0">{{ isset($shipping) ? 'Edit Shipping' : 'Create Shipping' }}</h5>
                    <div class="ms-auto">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <hr />
                        <form method="post" action="{{ isset($shipping) ? route('shippings.update', $shipping) : route('shippings.store') }}">
                            @csrf
                            @if (isset($shipping))
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="shipping_area" class="col-form-label">Shipping Area <span class="text-danger">*</span></label>
                                <input id="shipping_area" type="text" name="shipping_area" placeholder="Enter shipping area" value="{{ old('shipping_area', $shipping->shipping_area ?? '') }}" class="form-control" required>
                                @error('shipping_area')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="shipping_method" class="col-form-label">Shipping Method <span class="text-danger">*</span></label>
                                <input id="shipping_method" type="text" name="shipping_method" placeholder="Enter shipping method" value="{{ old('shipping_method', $shipping->shipping_method ?? '') }}" class="form-control" required>
                                @error('shipping_method')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="shipping_cost" class="col-form-label">Shipping Cost <span class="text-danger">*</span></label>
                                <input id="shipping_cost" type="number" name="shipping_cost" placeholder="Enter shipping cost" value="{{ old('shipping_cost', $shipping->shipping_cost ?? '') }}" class="form-control" step="0.01" required>
                                @error('shipping_cost')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if (isset($shipping)) <!-- Only show this if editing -->
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{(($shipping->status=='active')? 'selected' : '')}}>Active</option>
                                        <option value="inactive" {{(($shipping->status=='inactive')? 'selected' : '')}}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group mb-3 mt-3">
                                <button class="btn btn-primary" type="submit">{{ isset($shipping) ? 'Update' : 'Create' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
