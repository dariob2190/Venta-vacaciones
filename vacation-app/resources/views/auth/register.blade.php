@extends('app.bootstrap.template')

@section('title', 'Únete al Club | Luxury Escapes')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card card-luxury border-0 shadow-lg p-3">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <span class="text-uppercase text-accent ls-1 d-block mb-1">Membership</span>
                        <h2 class="font-serif">Create Account</h2>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label small text-muted text-uppercase ls-1">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control py-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your Full Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label small text-muted text-uppercase ls-1">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control py-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label small text-muted text-uppercase ls-1">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control py-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimum 8 characters">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label small text-muted text-uppercase ls-1">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control py-3" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password">
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-luxury py-3">
                                {{ __('Register') }}
                            </button>
                            <div class="text-center">
                                <span class="text-muted small">Already have an account?</span>
                                <a href="{{ route('login') }}" class="text-accent text-decoration-none fw-bold small ms-1">Log In</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection