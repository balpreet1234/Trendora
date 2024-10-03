@extends('layouts.admin.app')
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
                    <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card-header py-3 bg-transparent">
                <div class="d-sm-flex align-items-center">
                    <h4 class="mb-0 text-uppercase">Add Brand Details</h4>
                    <div class="ms-auto">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <form method="post" action="{{ route('brand.update',$data->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="inputTitle" class="col-form-label">Brand Name <span class="text-danger">*</span></label>
                                <input id="inputTitle" type="text" name="brand_name" placeholder="Enter brand name"
                                value="{{$data->brand_name}}" class="form-control">
                                @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputPhoto" class="col-form-label">Brand Logo/Image</label>
                                <div class="input-group">
                                    <input class="form-control" type="file" name="photo" id="photoInput" onchange="previewImage(event)">
                                </div>

                                <!-- Display existing image if it exists -->
                                @if(isset($data) && $data->photo)
                                    <div id="holder" style="margin-top:15px; max-height:100px;">
                                        <img src="{{ asset('storage/' . $data->photo) }}" class="img-fluid" width="100" alt="Brand Image">
                                    </div>
                                @else
                                    <div id="holder" style="margin-top:15px; max-height:100px;"></div>
                                @endif

                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="active" {{(($data->status=='active')? 'selected' : '')}}>Active</option>
                                    <option value="inactive" {{(($data->status=='inactive')? 'selected' : '')}}>Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3 mt-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function previewImage(event) {
        const holder = document.getElementById('holder');
        holder.innerHTML = '';

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid';
                img.width = 100;
                holder.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
