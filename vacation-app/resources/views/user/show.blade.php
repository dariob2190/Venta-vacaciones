@extends('app.bootstrap.template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-luxury border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="card-title font-serif mb-0">User Details</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end fw-bold text-muted">ID:</div>
                        <div class="col-md-8 text-accent font-monospace">#{{ $user->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end fw-bold text-muted">Name:</div>
                        <div class="col-md-8">{{ $user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end fw-bold text-muted">Email:</div>
                        <div class="col-md-8">{{ $user->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end fw-bold text-muted">Role:</div>
                        <div class="col-md-8"><span class="badge bg-secondary rounded-0 fw-normal text-uppercase">{{ $user->rol }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end fw-bold text-muted">Verified:</div>
                        <div class="col-md-8">
                            @if($user->hasVerifiedEmail()) 
                                <span class="text-success">✓ Verified</span> 
                            @else 
                                <span class="text-danger">✗ Not Verified</span> 
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end fw-bold text-muted">Member Since:</div>
                        <div class="col-md-8">{{ $user->created_at->format('d M, Y H:i A') }}</div>
                    </div>

                    <div class="border-top pt-3 mt-4 text-end">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary me-2">Back to List</a>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-luxury">Edit User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection