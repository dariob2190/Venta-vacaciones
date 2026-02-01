@extends('app.bootstrap.template')

@extends('app.bootstrap.template')

@section('content')

<div class="container py-5 mt-5">
    <div class="row mb-5">
        <div class="col-12">
            <span class="text-uppercase text-accent ls-1 mb-2 d-block">Administration</span>
            <h1 class="display-5 font-serif">User Management</h1>
        </div>
    </div>

    <div class="card card-luxury border-0 shadow-sm p-4">
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('user.create') }}" class="btn btn-luxury">Create User</a>
        </div>

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr class="text-uppercase small ls-1">
                    <th class="py-3">#</th>
                    <th class="py-3">Name</th>
                    <th class="py-3">Email</th>
                    <th class="py-3">Role</th>
                    <th class="py-3">Verified</th>
                    <th class="py-3 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="fw-bold text-accent">{{ $user->id }}</td>
                    <td class="fw-bold">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-secondary rounded-0 fw-normal text-uppercase">{{ $user->rol }}</span></td>
                    <td>@if($user->hasVerifiedEmail()) <span class="text-success">✓</span> @else <span class="text-danger">✗</span> @endif</td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                             <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-outline-success">View</a>
                             <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                             <button type="button" 
                                     class="btn btn-sm btn-outline-danger" 
                                     data-bs-toggle="modal" 
                                     data-bs-target="#confirmationModal" 
                                     data-action="{{ route('user.destroy', $user->id) }}"
                                     data-message="Are you sure you want to delete the user {{ $user->name }}?">
                                 Delete
                             </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Users:</th>
                    <th colspan="3">{{ count($users) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection