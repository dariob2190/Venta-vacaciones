@extends('app.bootstrap.template')

@section('title', 'Acceso Exclusivo | Luxury Escapes')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card card-luxury border-0 shadow-lg p-3">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <span class="text-uppercase text-accent ls-1 d-block mb-1">Welcome</span>
                        <h2 class="font-serif">Log In</h2>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label small text-muted text-uppercase ls-1">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control py-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label small text-muted text-uppercase ls-1">{{ __('Password') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="small text-accent text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <input id="password" type="password" class="form-control py-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary py-3">
                                {{ __('Login') }}
                            </button>
                            <a href="{{ route('register') }}" class="btn btn-outline-luxury py-3">
                                Create New Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
