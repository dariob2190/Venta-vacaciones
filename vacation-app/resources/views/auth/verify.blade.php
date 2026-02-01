@extends('app.bootstrap.template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-luxury border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="card-title font-serif mb-0">Verify Your Email Address</h4>
                </div>

                <div class="card-body p-4">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            A fresh verification link has been sent to your email address.
                        </div>
                    @endif

                    <p class="mb-3">Before proceeding, please check your email for a verification link.</p>
                    <p class="mb-0">If you did not receive the email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-accent text-decoration-none fw-bold">click here to request another</button>.
                    </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
