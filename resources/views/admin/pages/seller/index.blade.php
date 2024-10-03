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
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sellers</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('seller.create') }}">
                    <button type="button" class="btn btn-primary">Create Seller</button>
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <h5 class="mb-1">Seller Details</h5>

            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $seller)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $seller->name }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->phone }}</td>
                            <td>{{ $seller->address }}</td>
                            <td>
                                @if($seller->status == 'active')
                                    <span class="badge badge-success text-success">{{ $seller->status }}</span>
                                @else
                                    <span class="badge badge-warning text-danger">{{ $seller->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('seller.edit', $seller) }}" class="mb-2 mr-1" data-toggle="tooltip" title="Edit" data-placement="bottom">
                                    <i class="bi bi-pencil-fill" style="font-size: 14px;"></i>
                                </a>
                                <form method="POST" action="{{ route('seller.delete', $seller) }}" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('delete')
                                    <a class="delete_seller dltBtn" data-id="{{ $seller->id }}" data-toggle="tooltip" title="Delete">
                                        <i class="bi bi-trash-fill" style="font-size: 14px; color:red;"></i>
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
        const deleteButtons = document.querySelectorAll('.delete_seller');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Once deleted, you will not be able to recover this seller!",
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
                        Swal.fire('Cancelled', 'Your seller is safe!', 'info');
                    }
                });
            });
        });
    });
</script>

@endsection
