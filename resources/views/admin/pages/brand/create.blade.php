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
                        <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card-header py-3 bg-transparent">
                    <div class="d-sm-flex align-items-center">
                        <h4 class="mb-0 text-uppercase">Fill Brand Details</h4>
                        <div class="ms-auto">

                            <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>


                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="border p-3 rounded">


                            <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="inputTitle" class="col-form-label">Brand Name <span
                                            class="text-danger">*</span></label>
                                    <input id="inputTitle" type="text" name="brand_name" placeholder="Enter title"
                                        value="{{ old('title') }}" class="form-control">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inputPhoto" class="col-form-label">Brand logo/Image</label>
                                    <div class="input-group">
                                        <input class="form-control" type="file" name="photo">
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                                    @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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

@endsection


