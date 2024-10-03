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

              <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>

                 <a href="{{route('category.create')}}"> <button type="button" class="btn btn-primary">Update</button></a>

                </div>
              </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
				<div class="col-xl-6 mx-auto">

                    <div class="card">
                        <div class="card-body">
                            <div class="border p-3 rounded">
                                <h6 class="mb-0 text-uppercase">Checkout Form</h6>
                                <hr />

                                 @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="list-unstyled">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                 <form method="post" action="{{route('category.update',$category->id)}}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                                        <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{$category->title}}" class="form-control">
                                        @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTitle" class="col-form-label">slug <span class="text-danger">*</span></label>
                                        <input id="inputTitle" type="text" name="slug" placeholder="Enter slug" value="{{$category->slug}}" class="form-control">
                                        @error('slug')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTitle" class="col-form-label">Category Main Title (H1)<span class="text-danger">*</span></label>
                                        <input id="inputTitle" type="text" name="cate_main_title" placeholder="Enter Main Title" value="{{$category->cate_main_title}}" class="form-control">
                                        @error('cate_main_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTitle" class="col-form-label">Category Title (H2)<span class="text-danger">*</span></label>
                                        <input id="inputTitle" type="text" name="category_title" placeholder="Enter Main Title" value="{{$category->category_title}}" class="form-control">
                                        @error('category_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="summary" class="col-form-label">Summary</label>
                                        <textarea class="form-control" id="summary" name="summary">{{$category->summary}}</textarea>
                                        @error('summary')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="is_parent">Is Parent</label><br>
                                        <input type="checkbox" name='is_parent' id='is_parent' value='{{$category->is_parent}}' {{(($category->is_parent==1)? 'checked' : '')}}> Yes
                                    </div>
                                    {{-- {{$parent_cats}} --}}
                                    {{-- {{$category}} --}}

                                    <div class="form-group {{(($category->is_parent==1) ? 'd-none' : '')}}" id='parent_cat_div'>
                                        <label for="parent_id">Parent Category</label>
                                        <select name="parent_id" class="form-control">
                                            <option value="">--Select any category--</option>
                                            @foreach($parent_cats as $key=>$parent_cat)

                                            <option value='{{$parent_cat->id}}' {{(($parent_cat->id==$category->parent_id) ? 'selected' : '')}}>{{$parent_cat->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPhoto" class="col-form-label">Photo</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$category->photo}}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                        @error('photo')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{(($category->status=='active')? 'selected' : '')}}>Active</option>
                                            <option value="inactive" {{(($category->status=='inactive')? 'selected' : '')}}>Inactive</option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTitle" class="col-form-label">Meta Title</label>
                                        <input id="inputTitle" type="text" name="meta_title" placeholder="Enter Meta Title" value="{{$category->meta_title}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTitle" class="col-form-label">Meta Description</label>
                                        <input id="inputTitle" type="text" name="meta_description" placeholder="Enter Meta Description" value="{{$category->meta_description}}" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <button class="btn btn-success" type="submit">Update</button>
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
