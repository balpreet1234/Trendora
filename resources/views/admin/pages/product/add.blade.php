@extends('layouts.admin.app')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />

@section('content')

<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="mb-2 mb-sm-0">Add New Product</h5>
                        <div class="ms-auto">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>
                            <button type="button" class="btn btn-primary" id="product_store">Add Now</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <form class="row p-3" method="post" action="{{ route('product.store') }}" id="product_add" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 col-lg-8">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">

                                        <div class="col-12">
                                            <label class="form-label">Product Title</label>
                                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Product title">
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 d-flex gap-2 p-2">
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">Stock</label>
                                            <input type="text" name="stock" value="{{ old('stock') }}" class="form-control" placeholder="Stock">
                                            @error('stock')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">SKU</label>
                                            <input type="text" name="sku" value="{{ old('sku') }}" class="form-control" placeholder="SKU">
                                            @error('sku')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-12 d-flex gap-2 p-2">
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Colors</label>
                                                <div id="color-inputs">
                                                    <input type="color" name="colors[]" class="form-control" value="{{ old('colors.0') }}">
                                                </div>
                                                <button type="button" id="add-color" class="btn btn-primary mt-2">Add Color</button>
                                                @error('colors.*')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">Size</label>
                                            <input type="text" name="size" value="{{ old('size') }}" class="form-control" placeholder="Size">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customSize">
                                                <label class="form-check-label" for="customSize">Custom Size</label>
                                            </div>
                                            <div id="customSizeFields" style="display: none;">
                                                <input type="number" name="height" class="form-control mt-2" placeholder="Height (cm)">
                                                <input type="number" name="width" class="form-control mt-2" placeholder="Width (cm)">
                                            </div>
                                            @error('size')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Brand</label>
                                            <select class="form-select " name="brand">
                                                <option value="" >
                                                    select
                                                </option>
                                                @foreach($brand as $category)
                                                <option value="{{ $category->id }}">{{ $category->brand_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Images</label>
                                            <input class="form-control" type="file" name="photo[]" multiple>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Video</label>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customVideo">
                                                <label class="form-check-label" for="customVideo">Add Video</label>
                                            </div>
                                            <div id="videoFields" style="display: none;">
                                                <input type="url" name="video_url" class="form-control mt-2" placeholder="Video URL" required>
                                                <input class="form-control mt-2" type="file" name="video_thumbnail" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Full Description</label>
                                            <textarea class="form-control" name="description" placeholder="Full description" rows="4">{{ old('description') }}</textarea>
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Price</label>
                                                <input type="text" name="price" class="form-control" placeholder="Price" required>
                                                @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Discount</label>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customDiscount">
                                                    <label class="form-check-label" for="customDiscount">Add Discount</label>
                                                </div>
                                                <div id="discountFields" style="display: none;">
                                                    <input type="number" name="discount" class="form-control mt-2" placeholder="Discount Amount" min="0" step="0.01">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="Active">Published</option>
                                                    <option value="Unactive">Draft</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Tags</label>
                                                <select class="form-select js-example-basic-multiple" name="tags[]" multiple>
                                                    <option value="new-product">New Product</option>
                                                    <option value="most-demanding-products">Most Demanding Products</option>
                                                    <option value="top-sellers">Top sellers</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Categories</label>
                                                <select class="form-select js-example-basic-multiple" name="categories[]" multiple>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

@endsection

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script>
    document.getElementById('add-color').addEventListener('click', function() {
        const colorInputs = document.getElementById('color-inputs');
        const newColorInput = document.createElement('input');
        newColorInput.type = 'color';
        newColorInput.name = 'colors[]';
        newColorInput.className = 'form-control mt-2';
        colorInputs.appendChild(newColorInput);
    });
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();

        $('#customSize').change(function() {
            $('#customSizeFields').toggle(this.checked);
        });

        $('#customVideo').change(function() {
            $('#videoFields').toggle(this.checked);
        });

        $('#customDiscount').change(function() {
            $('#discountFields').toggle(this.checked);
        });
    });

    $('#product_store').click(function(e) {
        e.preventDefault();
        $('#product_add').submit();
    });

</script>

@endsection
