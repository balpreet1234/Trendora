@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">User</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card-header py-3 bg-transparent">
                <div class="d-sm-flex align-items-center">
                    <h5 class="mb-2 mb-sm-0">User details</h5>
                    <div class="ms-auto">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User Details</h5>

                    <div class="mb-3">
                        <strong>ID:</strong> {{ $user->id }}
                    </div>
                    <div class="mb-3">
                        <strong>Name:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mb-3">
                        <strong>Email Verified At:</strong> {{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i:s') : 'Not Verified' }}
                    </div>
                    <div class="mb-3">
                        <strong>Address:</strong> {{ $user->address }}
                    </div>
                    <div class="mb-3">
                        <strong>Country ID:</strong> {{ $user->country_id }}
                    </div>
                    <div class="mb-3">
                        <strong>State ID:</strong> {{ $user->state_id }}
                    </div>
                    <div class="mb-3">
                        <strong>City ID:</strong> {{ $user->city_id }}
                    </div>
                    <div class="mb-3">
                        <strong>Zip Code:</strong> {{ $user->zipcode }}
                    </div>
                    <div class="mb-3">
                        <strong>Role:</strong> {{ $user->role }}
                    </div>
                    <div class="mb-3">
                        <strong>Phone:</strong> {{ $user->phone }}
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong> {{ $user->status }}
                    </div>
                    <div class="mb-3">
                        <strong>Created At:</strong> {{ $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : 'N/A' }}
                    </div>
                    <div class="mb-3">
                        <strong>Updated At:</strong> {{ $user->updated_at ? $user->updated_at->format('Y-m-d H:i:s') : 'N/A' }}
                    </div>

                    <a href="{{ route('user.index') }}" class="btn btn-primary">Back to Users</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
