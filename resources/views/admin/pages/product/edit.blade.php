@extends('layouts.admin.app')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
<style>
    .image-container {
        width: 200px;

        height: 100px;
        /* Set the fixed height */
        overflow: hidden;
        /* Hide overflow */
        display: flex;
        /* Center the image */
        justify-content: center;
        align-items: center;
        position: relative;
        /* For positioning the remove button */
        border: 1px solid #ddd;
        /* Optional: Add a border for clarity */
        margin-bottom: 10px;
        /* Optional: Add spacing between images */
    }

    .image-container img {
        width: 100%;
        /* Scale the image to fill the width */
        height: auto;
        /* Maintain aspect ratio */
        max-height: 100%;
        /* Prevent the image from exceeding the container height */
    }

    .remove-image {
        position: absolute;
        top: 5px;
        /* Adjust to position the button inside the container */
        right: 5px;
        /* Adjust to position the button inside the container */
        z-index: 10;
        /* Ensure it stays above the image */
        background: rgba(255, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 20px;
        cursor: pointer;
    }

</style>
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
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">

                <div class="card-body">
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Edit Product</h5>
                            <div class="ms-auto">

                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>

                                <button type="button" class="btn btn-primary" id="product_store">Update Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 p-3">
                        <form class="row p-3" method="post" action="{{ route('product.update', $product->id) }}" id="product_add" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-12 col-lg-8">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <label class="form-label">Product Title</label>
                                            <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-control" placeholder="Product title">
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 d-flex gap-2 p-2">
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Stock</label>
                                                <input type="text" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" placeholder="Stock">
                                                @error('stock')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">SKU</label>
                                                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control" placeholder="SKU">
                                                @error('sku')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex gap-2 p-2">

                                                <div class="col-12 col-lg-6">
                                                    <label class="form-label">Colors</label>
                                                    <div id="colorInputs">
                                                        @php
                                                            $colors = json_decode($product->color, true); // Decode the JSON string into an array
                                                        @endphp
                                                        @foreach($colors as $color)
                                                            <div class="input-group mb-2">
                                                                <input type="color" name="colors[]" class="form-control" value="{{ $color }}">
                                                                <button type="button" class="btn btn-danger remove-color">×</button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button type="button" class="btn btn-secondary" id="addColor">Add Color</button>
                                                    @error('colors.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Size</label>
                                                <input type="text" name="size" value="{{ old('size', $product->size) }}" class="form-control" placeholder="Size">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customSize" {{ old('customSize', $product->custom_size) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="customSize">Custom Size</label>
                                                </div>
                                                <div id="customSizeFields" style="{{ old('customSize', $product->custom_size) ? '' : 'display: none;' }}">
                                                    <input type="number" name="height" value="{{ old('height', $product->height) }}" class="form-control mt-2" placeholder="Height (cm)">
                                                    <input type="number" name="width" value="{{ old('width', $product->width) }}" class="form-control mt-2" placeholder="Width (cm)">
                                                </div>
                                                @error('size')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Brand</label>
                                            <select class="form-select" name="brand">
                                                <option value="" >
                                                    select
                                                </option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->brand_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('brand')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Images</label>
                                            <input class="form-control" type="file" name="photo[]" multiple>
                                            <small>Leave blank to keep existing images.</small>

                                            <div class="mt-3">
                                                <div class="your-image-display-selector d-flex flex-wrap">
                                                    @foreach($product->galleries as $index => $gallery)
                                                    @if($index < 3) <div class="image-container me-2">
                                                        <img src="{{ asset('storage/' . $gallery->photo) }}" class="img-fluid" alt="Product Image" height="100px" width="200">
                                                        <button type="button" class="btn btn-danger btn-sm remove-image" data-id="{{ $gallery->id }}">×</button>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>

                                            @if($product->galleries->count() > 3)
                                            <button type="button" class="btn btn-link" id="showMoreImages">Show More</button>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imageModalLabel">All Images</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @foreach($product->galleries as $gallery)
                                                        <div class="col-4 mb-2">
                                                            <div class="image-container">
                                                                <img src="{{ asset('storage/' . $gallery->photo) }}" class="img-fluid" alt="Product Image" height="100px" width="200px">
                                                                <button type="button" class="btn btn-danger btn-sm remove-image" data-id="{{ $gallery->id }}">×</button>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <label class="form-label">Video</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customVideo" {{ old('customVideo', $product->video_url) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="customVideo">Add Video</label>
                                        </div>
                                        <div id="videoFields" style="{{ old('customVideo', $product->video_url) ? '' : 'display: none;' }}">
                                            <input type="url" name="video_url" value="{{ old('video_url', $product->video_url) }}" class="form-control mt-2" placeholder="Video URL">
                                            <input class="form-control mt-2" type="file" name="video_thumbnail">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Full Description</label>
                                        <textarea class="form-control" name="description" placeholder="Full description" rows="4">{{ old('description', $product->description) }}</textarea>
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
                                        <input type="text" name="price" value="{{ old('price', $product->price) }}" class="form-control" placeholder="Price" required>
                                        @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Discount</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customDiscount" {{ old('customDiscount', $product->discount) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="customDiscount">Add Discount</label>
                                        </div>
                                        <div id="discountFields" style="{{ old('customDiscount', $product->discount) ? '' : 'display: none;' }}">
                                            <input type="number" name="discount" value="{{ old('discount', $product->discount) }}" class="form-control mt-2" placeholder="Discount Amount" min="0" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status">
                                            <option value="Active" {{ $product->status == 'Active' ? 'selected' : '' }}>Published</option>
                                            <option value="Unactive" {{ $product->status == 'Unactive' ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Tags</label>
                                        <select class="form-select js-example-basic-multiple" name="tags[]" multiple>
                                            @php
                                            $selectedTags = explode(',', $product->tags); // Convert the tags string to an array
                                            @endphp
                                            <option value="new-product" {{ in_array('new-product', $selectedTags) ? 'selected' : '' }}>Tag1</option>
                                            <option value="most-demanding-products" {{ in_array('most-demanding-products', $selectedTags) ? 'selected' : '' }}>Tag2</option>
                                            <option value="top-sellers" {{ in_array('top-sellers', $selectedTags) ? 'selected' : '' }}>Tag3</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Categories</label>
                                        <select class="form-select js-example-basic-multiple" name="cat_id[]" multiple>
                                            @php
                                            // Convert the cat_id string to an array, trimming any whitespace
                                            $selectedCategoryIds = array_map('trim', explode(',', $product->cat_id));
                                            @endphp

                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategoryIds) ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <!--end row-->
            </div>
        </div>
        <!--end row-->
    </div>
    </div>
</main>

@endsection

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let existingImages = [];

    function loadExistingImages() {
        existingImages = [];
        $('.remove-image').each(function() {
            const imageId = $(this).data('id');
            const imageUrl = $(this).siblings('img').attr('src');
            existingImages.push({ id: imageId, url: imageUrl });
        });
        console.log("Images loaded on page load:", existingImages);
    }

    loadExistingImages();

    $('#showMoreImages').on('click', function() {
        $('#imageModal').modal('show');
    });


    $(document).on('click', '.remove-image', function() {
        const imageId = $(this).data('id');
        const row = $(this).closest('.col-4');

        $.ajax({
            url: `/product/image/remove/${imageId}`,
            type: 'DELETE',
            success: function(response) {
                if (response.success) {

                    row.remove();

                    existingImages = existingImages.filter(img => img.id !== imageId);
                    console.log("Image removed successfully, updated array:", existingImages);

                    updateImageDisplay();
                } else {
                    alert('Failed to remove the image.');
                }
            },
            error: function() {
                alert('Failed to remove the image.');
            }
        });
    });


    function updateImageDisplay() {
        console.log("Updating main image display...");

        $('.your-image-display-selector').empty();


        const mainImagesToShow = existingImages.slice(0, 3);

        mainImagesToShow.forEach(function(image) {
            $('.your-image-display-selector').append(`
                <div class="image-container me-2">
                    <img src="${image.url}" class="img-fluid" alt="Product Image" height="100px" width="200px">
                    <button type="button" class="btn btn-danger btn-sm remove-image" data-id="${image.id}">×</button>
                </div>
            `);
        });


        if (existingImages.length > 3) {
            $('#showMoreImages').show();
        } else {
            $('#showMoreImages').hide();
        }

        console.log("Main display updated, current visible images:", mainImagesToShow);
    }


    $('#imageModal').on('hidden.bs.modal', function() {
        console.log("Modal closed, refreshing main display...");
        updateImageDisplay();
    });


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

    $('#product_store').click(function(e) {
        e.preventDefault();
        $('#product_add').submit();
    });
    $('#addColor').click(function() {
        $('#colorInputs').append(`
            <div class="input-group mb-2">
                <input type="color" name="colors[]" class="form-control">
                <button type="button" class="btn btn-danger remove-color">×</button>
            </div>
        `);
    });

    $(document).on('click', '.remove-color', function() {
        $(this).closest('.input-group').remove();
    });
});


</script>


<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
