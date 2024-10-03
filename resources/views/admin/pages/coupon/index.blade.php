@extends('layouts.admin.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                    <li class="breadcrumb-item active" aria-current="page">Coupons</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('coupons.create') }}"> <button type="button" class="btn btn-primary">Create</button></a>

            </div>
        </div>
    </div>
    <!--end breadcrumb-->



    <div class="card">
        <div class="card-body">

            <h5 class="mb-1">Coupons Details</h5>

            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)

                        <tr class="text-center">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$coupon->code}}</td>
                            <td>{{$coupon->discount}}</td>
                            <td>{{ $coupon->category->title }}</td>


                            <td>
                                @if($coupon->status=='active')
                                <span class="badge badge-success text-success">{{$coupon->status}}</span>
                                @else
                                <span class="badge badge-warning text-danger">{{$coupon->status}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('coupons.edit', $coupon) }}" class="mb-2 mr-1" data-toggle="tooltip" title="edit" data-placement="bottom">
                                    <i class="bi bi-pencil-fill" style="font-size: 14px;"></i>
                                </a>
                                <form method="POST" action="{{ route('coupons.destroy', $coupon) }}" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('delete')
                                    <a class="delete_coupon dltBtn" data-id="{{$coupon->id}}" data-toggle="tooltip" title="Delete">
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
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete_coupon');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?'
                    , text: "Once deleted, you will not be able to recover this product!"
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#3085d6'
                    , cancelButtonColor: '#d33'
                    , confirmButtonText: 'Yes, delete it!'
                    , cancelButtonText: 'Cancel'
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
