@extends('layouts.admin.app')

@section('content')
<main class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">Admin Profile</div>
        <div class="ms-auto">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Admin Details</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3>{{ $user->name }}</h3>
                        <p class="text-muted">{{ $user->role }}</p>
                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning">Edit Profile</a>
                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Email:</strong>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Email Verified At:</strong>
                            <p>{{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i:s') : 'Not Verified' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Phone:</strong>
                            <p>{{ $user->phone }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Address:</strong>
                            <p>{{ $user->address }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Status:</strong>
                            <p>{{ $user->status }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Created At:</strong>
                            <p>{{ $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Updated At:</strong>
                            <p>{{ $user->updated_at ? $user->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
