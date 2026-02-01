@extends('app.bootstrap.template')

@section('title', $vacacion->titulo . ' | Luxury Escapes')

@section('hero')
<div class="detail-header" style="background-image: url('{{ $vacacion->url }}');"></div>
@endsection

@section('content')
@section('content')
<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="detail-content">
                <div class="row">
                    <div class="col-md-8">
                        <span class="text-uppercase text-warning fw-bold ls-1 mb-2 d-block">{{ $vacacion->pais }}</span>
                        <h1 class="display-4 mb-4">{{ $vacacion->titulo }}</h1>
                        
                        <div class="d-flex gap-3 mb-5">
                            <span class="badge bg-light text-dark border px-3 py-2">{{ $vacacion->tipo->nombre ?? 'Experience' }}</span>
                            <!-- Add more badges/icons if available -->
                        </div>

                        <div class="lead text-muted mb-5" style="line-height: 2;">
                            {{ $vacacion->descripcion }}
                        </div>

                        <!-- Itinerary -->
                        <div class="mb-5">
                            <h3 class="font-serif mb-4">Experience Itinerary</h3>
                            <div class="border-start border-2 border-accent ms-3">
                                @if($vacacion->itinerario)
                                    @foreach(explode("\n", $vacacion->itinerario) as $line)
                                        @php
                                            $parts = explode(':', $line, 2);
                                            $title = isset($parts[0]) ? trim($parts[0]) : '';
                                            $desc = isset($parts[1]) ? trim($parts[1]) : $line;
                                        @endphp
                                        <div class="mb-4 position-relative ps-4">
                                            <div class="position-absolute start-0 top-0 translate-middle-x bg-white border border-accent rounded-circle p-1" style="width: 12px; height: 12px; top: 8px !important;"></div>
                                            <h5 class="fw-bold text-dark">{{ $title }}</h5>
                                            <p class="text-muted">{{ $desc }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted ps-4">Itinerary details coming soon.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Map Placeholder -->
                        <div class="mb-5">
                            <h3 class="font-serif mb-4">Location</h3>
                            <div class="bg-light p-2 rounded border">
                                <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ urlencode($vacacion->pais) }}&t=&z=5&ie=UTF8&iwloc=&output=embed"></iframe>
                            </div>
                        </div>

                        <!-- Related Trips -->
                        @if($related_vacations->count() > 0)
                        <div class="mt-5 pt-5 border-top">
                            <h3 class="mb-4 font-serif">You might also be inspired by</h3>
                            <div class="row g-3">
                                @foreach($related_vacations as $related)
                                <div class="col-md-6">
                                    <div class="card card-luxury h-100 shadow-sm border-0">
                                        <img src="{{ $related->url }}" class="card-img-top" alt="{{ $related->titulo }}" style="height: 150px; object-fit: cover;">
                                        <div class="card-body p-3">
                                            <h6 class="card-title font-serif small fw-bold mb-1">{{ $related->titulo }}</h6>
                                            <span class="text-muted small d-block mb-2">{{ $related->pais }}</span>
                                            <a href="{{ route('vacaciones.show', $related->id) }}" class="btn btn-link text-accent p-0 small text-decoration-none text-uppercase ls-1 fw-bold">View Trip →</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="mt-5 pt-5 border-top">
                            <h3 class="mb-4">Traveler Reviews</h3>
                            @forelse($vacacion->comentarios as $comentario)
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                {{ substr($comentario->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $comentario->user->name }}</h6>
                                                <small class="text-muted">{{ $comentario->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        @if(Auth::id() === $comentario->user->id)
                                            <button type="button" 
                                                    class="btn btn-link text-danger p-0 small text-decoration-none" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#confirmationModal" 
                                                    data-action="{{ route('comentarios.destroy', $comentario->id) }}"
                                                    data-message="Delete this comment?">
                                                Delete
                                            </button>
                                        @endif
                                    </div>
                                    <p class="text-muted ms-5">{{ $comentario->texto }}</p>
                                </div>
                            @empty
                                <p class="text-muted fst-italic">Be the first to share your experience.</p>
                            @endforelse
                        </div>

                        <!-- Add Comment Form -->
                        @auth
                            @if($hasReserved)
                                <div class="mt-5 pt-5 border-top">
                                    <h3 class="mb-4">Leave your opinion</h3>
                                    <form action="{{ route('comentarios.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_vacacion" value="{{ $vacacion->id }}">
                                        <div class="mb-3">
                                            <textarea name="texto" class="form-control" rows="4" placeholder="Share your experience..." required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-luxury">Post Comment</button>
                                    </form>
                                </div>
                            @elseif(!$vacacion->reservas()->where('id_user', Auth::id())->exists())
                                <div class="mt-5 pt-5 border-top text-center">
                                    <p class="text-muted fst-italic">Book this trip to share your experience.</p>
                                </div>
                            @endif
                        @endauth
                    </div>
                    
                    <div class="col-md-4">
                        <div class="sticky-top" style="top: 100px;">
                            <div class="bg-light p-4 border rounded-0">
                                <span class="d-block text-muted text-uppercase small mb-1">Price per person</span>
                                <div class="price-tag mb-4">${{ number_format($vacacion->precio_por_persona) }}</div>
                                
                                <ul class="list-unstyled mb-4 text-muted small">
                                    <li class="mb-2">✓ Luxury accommodation included</li>
                                    <li class="mb-2">✓ Expert private guide</li>
                                    <li class="mb-2">✓ Premium transport</li>
                                </ul>

                                @auth
                                    @if(!$hasReserved)
                                        <form action="{{ route('reservas.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_vacacion" value="{{ $vacacion->id }}">
                                            <button type="submit" class="btn btn-luxury w-100 py-3">
                                                Confirm Reservation
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary w-100 py-3" disabled>
                                            Reservation Confirmed
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-luxury w-100 py-3">
                                        Log In
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
