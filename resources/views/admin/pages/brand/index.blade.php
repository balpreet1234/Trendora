@extends('layouts.admin.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                    <li class="breadcrumb-item active" aria-current="page">List</li>
                  </ol>
                </nav>
              </div>
              <div class="ms-auto">
                <div class="btn-group">
                 <a href="{{route('brand.create')}}"> <button type="button" class="btn btn-primary">Create</button></a>

                </div>
              </div>
            </div>
            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Brand Name</th>
                                    <th>status</th>



                                    <th>Date</th>
                                    <th>Actions</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $product)
                                    <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if($product->photo)
                                                <img src="{{ asset('storage/' . $product->photo) }}" class="img-fluid" width="35" alt="product">
                                            @else
                                                <img src="{{ asset('path/to/placeholder.png') }}" class="img-fluid" width="35" alt="placeholder">
                                            @endif
                                        </td>


                                        <td>{{ $product->brand_name }}</td>
                                        <td> @if($product->status=='active')
                                            <span class="badge badge-success text-success f1">{{$product->status}}</span>
                                        @else
                                            <span class="badge badge-warning text-danger f1">{{$product->status}}</span>
                                        @endif</td>

                                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('brand.edit', $product->id) }}" class="mb-2 mr-1" data-toggle="tooltip" title="edit" data-placement="bottom">
                                                <i class="bi bi-pencil-fill" style="font-size: 14px;"></i>
                                            </a>
                                            <form method="POST" action="{{ route('brand.delete', $product->id) }}" style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('delete')
                                                <a  class="delete_category dltBtn" data-id="{{ $product->id }}" data-toggle="tooltip" title="Delete">
                                                    <i class="bi bi-trash-fill" style="font-size: 14px;color:red;"></i>
                                                </a>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


        </main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete_category');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Once deleted, you will not be able to recover this product!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else {
                        Swal.fire('Cancelled', 'Your product is safe!', 'info');
                    }
                });
            });
        });
    });
</script>




@endsection



