@extends('app.bootstrap.template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-luxury border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="card-title font-serif mb-0">My Dashboard</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="lead mb-4">You are logged in!</p>
                    
                    <div class="bg-light p-4 rounded">
                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold text-uppercase small text-muted">Name:</div>
                            <div class="col-md-9">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold text-uppercase small text-muted">Email:</div>
                            <div class="col-md-9">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold text-uppercase small text-muted">Member Since:</div>
                            <div class="col-md-9">{{ Auth::user()->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold text-uppercase small text-muted">Last Update:</div>
                            <div class="col-md-9">{{ Auth::user()->updated_at->format('M d, Y H:i') }}</div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="{{ route('home.edit') }}" class="btn btn-luxury">Edit your profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
