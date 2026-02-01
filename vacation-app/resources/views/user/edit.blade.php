@extends('app.bootstrap.template')

@extends('app.bootstrap.template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-luxury border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="card-title font-serif mb-0">Edit User</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Leave blank to keep current password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="rol" class="col-md-4 col-form-label text-md-end">Role:</label>
                            <div class="col-md-6">
                                <select required name="rol" id="rol" class="form-control">
                                    <option value=""
                                        @if(old('rol', $user->rol) == null)
                                            selected
                                        @endif
                                    disabled>Select an option...</option>
                                    @foreach($rols as $rol)
                                        <option value="{{ $rol }}"
                                            @if($rol == old('rol', $user->rol))
                                                selected
                                            @endif
                                        >{{ $rol }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="verified" class="col-md-4 col-form-label text-md-end">Verified Email</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <input id="verified" type="checkbox" name="verified" value="verified" class="form-check-input mt-0" @if($user->hasVerifiedEmail()) checked @endif>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 d-flex gap-2">
                                <button type="submit" class="btn btn-luxury">
                                    Update User
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection