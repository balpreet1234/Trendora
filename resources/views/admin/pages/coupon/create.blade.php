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
                    <li class="breadcrumb-item active" aria-current="page">Coupons</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card-header py-3 bg-transparent">
                <div class="d-sm-flex align-items-center">
                    <h5 class="mb-2 mb-sm-0">{{ isset($coupon) ? 'Edit Coupon' : 'Create Coupon' }}</h5>
                    <div class="ms-auto">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Coupon Form</h6>
                        <hr />
                        <form method="post" action="{{ isset($coupon) ? route('coupons.update', $coupon) : route('coupons.store') }}">
                            @csrf
                            @if (isset($coupon))
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="code" class="col-form-label">Code <span class="text-danger">*</span></label>
                                <input id="code" type="text" name="code" placeholder="Enter coupon code" value="{{ old('code', $coupon->code ?? '') }}" class="form-control" required>
                                @error('code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="discount" class="col-form-label">Discount <span class="text-danger">*</span></label>
                                <input id="discount" type="number" name="discount" placeholder="Enter discount amount" value="{{ old('discount', $coupon->discount ?? '') }}" class="form-control" required>
                                @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="col-form-label">Category <span class="text-danger">*</span></label>
                                <select name="cat_id" id="cat_id" class="form-control" required>
                                    <option value="">--Select Category--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ (isset($coupon) && $coupon->category_id == $category->id) ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cat_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="active" {{(($coupon->status=='active')? 'selected' : '')}}>Active</option>
                                    <option value="inactive" {{(($coupon->status=='inactive')? 'selected' : '')}}>Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 mt-3">
                                <button class="btn btn-primary" type="submit">{{ isset($coupon) ? 'Update' : 'Create' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
