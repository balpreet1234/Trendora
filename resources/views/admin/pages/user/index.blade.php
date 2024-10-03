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
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <h5 class="mb-1">User Details</h5>

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
                        @foreach ($data as $user)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                @if($user->status == 'active')
                                    <span class="badge badge-success text-success">{{ $user->status }}</span>
                                @else
                                    <span class="badge badge-warning text-danger">{{ $user->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('users.view',$user)}}" class="mb-2 mr-1" data-toggle="tooltip" title="View" data-placement="bottom">
                                    <i class="bi bi-eye" style="font-size: 14px;"></i>
                                </a>
                                <form method="POST" action="{{route('user.delete',$user)}}" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('delete')
                                    <a class="delete_user dltBtn" data-id="{{ $user->id }}" data-toggle="tooltip" title="Delete">
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
        const deleteButtons = document.querySelectorAll('.delete_user');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Once deleted, you will not be able to recover this user!",
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
                        Swal.fire('Cancelled', 'Your user is safe!', 'info');
                    }
                });
            });
        });
    });
</script>

@endsection
