@extends('app.bootstrap.template')

@section('title', 'My Trips | Luxury Escapes')

@section('content')
<div class="container py-5 mt-5">
    <div class="row mb-5">
        <div class="col-12">
            <span class="text-uppercase text-accent ls-1 mb-2 d-block">My Collection</span>
            <h1 class="display-5 font-serif">Booked Trips</h1>
        </div>
    </div>

    @forelse($reservas as $reserva)
        <div class="card card-luxury mb-4 border-0 shadow-sm overflow-hidden">
            <div class="row g-0">
                <div class="col-md-3">
                    <img src="{{ $reserva->vacacion->url }}" class="img-fluid h-100 object-fit-cover" alt="{{ $reserva->vacacion->titulo }}">
                </div>
                <div class="col-md-9">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                             <small class="text-muted text-uppercase ls-1">Booked on {{ $reserva->created_at->format('d M, Y') }}</small>
                             <span class="badge bg-success rounded-0 fw-normal text-uppercase ls-1 px-3 py-2">Confirmed</span>
                        </div>
                        <h3 class="card-title font-serif mb-3">{{ $reserva->vacacion->titulo }}</h3>
                        <p class="text-muted mb-4">{{ Str::limit($reserva->vacacion->descripcion, 150) }}</p>
                        <div class="d-flex align-items-center justify-content-between border-top pt-3">
                            <div>
                                <small class="text-muted d-block">Destination</small>
                                <span class="fw-bold">{{ $reserva->vacacion->pais }}</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" 
                                        class="btn btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmationModal" 
                                        data-action="{{ route('reservas.destroy', $reserva->id) }}"
                                        data-message="Are you sure you want to cancel this reservation?">
                                    Cancel
                                </button>
                                <a href="{{ route('vacaciones.show', $reserva->vacacion->id) }}" class="btn btn-outline-luxury">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <h3 class="text-muted font-serif mb-4">You have no upcoming trips.</h3>
            <a href="{{ route('vacaciones.index') }}" class="btn btn-primary btn-lg">Explore Destinations</a>
        </div>
    @endforelse

    <div class="mt-5">
        {{ $reservas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
