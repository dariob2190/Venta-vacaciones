@extends('app.bootstrap.template')

@section('title', 'Manage Experiences | Luxury Escapes')

@section('content')
<div class="container py-5 mt-5">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h1 class="display-6 font-serif">Manage Experiences</h1>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('vacaciones.create') }}" class="btn btn-luxury">
                Create New Experience
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary ms-2">
                Back to Dashboard
            </a>
        </div>
    </div>

    <div class="card card-luxury border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-uppercase small ls-1">
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Title</th>
                            <th class="py-3">Type</th>
                            <th class="py-3">Location</th>
                            <th class="py-3">Price</th>
                            <th class="py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vacacions as $vacacion)
                        <tr>
                            <td class="ps-4 text-muted">#{{ $vacacion->id }}</td>
                            <td class="fw-bold">{{ $vacacion->titulo }}</td>
                            <td><span class="badge bg-secondary rounded-0 fw-normal text-uppercase">{{ $vacacion->tipo->nombre }}</span></td>
                            <td>{{ $vacacion->ciudad }}, {{ $vacacion->pais }}</td>
                            <td class="font-serif text-accent">{{ number_format($vacacion->precio_por_persona, 2) }}€</td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('vacaciones.show', $vacacion->id) }}" class="btn btn-sm btn-outline-secondary" target="_blank">View</a>
                                    <a href="{{ route('vacaciones.edit', $vacacion->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#confirmationModal"
                                            data-action="{{ route('vacaciones.destroy', $vacacion->id) }}"
                                            data-message="Are you sure you want to delete this experience? This action cannot be undone.">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3">
             {{ $vacacions->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
