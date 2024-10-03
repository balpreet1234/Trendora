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
                            <h5 class="mb-2 mb-sm-0">Edit Product</h5>
                            <div class="ms-auto">

                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>


                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-3 rounded">
                                <h6 class="mb-0 text-uppercase">Checkout Form</h6>
                                <hr />
                                <form method="post" action="{{route('category.store')}}"  enctype="multipart/form-data">
                                   @csrf
                                    <div class="form-group">
                                    <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                                    <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
                                    @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label for="summary" class="col-form-label">Summary</label>
                                    <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
                                    @error('summary')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                    <label for="is_parent">Is Parent</label><br>
                                    <input type="checkbox" name='is_parent' id='is_parent' value='1' checked> Yes
                                    </div>
                                    {{-- {{$parent_cats}} --}}

                                    <div class="form-group d-none" id='parent_cat_div'>
                                    <label for="parent_id">Parent Category</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="">--Select any category--</option>
                                        {{-- @foreach($parent_cats as $key=>$parent_cat)
                                            <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                                        @endforeach --}}
                                    </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPhoto" class="col-form-label">Photo</label>
                                        <div class="input-group">
                                            <input class="form-control" type="file" name="photo" >
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
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

@endsection


@section('scripts')

<script>
 $('#is_parent').change(function(){
        var is_checked=$('#is_parent').prop('checked');
        // alert(is_checked);
        if(is_checked){
        $('#parent_cat_div').addClass('d-none');
        $('#parent_cat_div').val('');
        }
        else{
        $('#parent_cat_div').removeClass('d-none');
        }
    })
</script>
@endsection
