@extends('app.bootstrap.template')

@section('title', 'Luxury Escapes | Exclusive Destinations')

@section('hero')
<div class="hero-section">
    <div class="hero-content">
        <h1>The Art of Travel</h1>
        <p>Discover Destinations curated for the most discerning travelers.</p>
        <button class="btn btn-luxury" onclick="document.getElementById('destinos').scrollIntoView({behavior: 'smooth'})">Explore Collection</button>
    </div>
</div>

<!-- Why Choose Us -->
<div class="container py-5 mb-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="p-4">
                <div class="h1 text-accent mb-3">★</div>
                <h4 class="font-serif mb-3">Concierge Service</h4>
                <p class="text-muted">24/7 personalized attention so your only concern is enjoyment.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4">
                <div class="h1 text-accent mb-3">✦</div>
                <h4 class="font-serif mb-3">Exclusive Access</h4>
                <p class="text-muted">Unique experiences and destinations, closed to the general public.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4">
                <div class="h1 text-accent mb-3">🛡</div>
                <h4 class="font-serif mb-3">Premium Guarantee</h4>
                <p class="text-muted">If it doesn't exceed your expectations, we rectify it instantly.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div id="destinos" class="container py-5">
    <div class="row mb-5 align-items-end">
        <div class="col-md-8">
            <span class="text-muted text-uppercase ls-1">Our Selection</span>
            <h2 class="display-4">Exclusive Destinations</h2>
        </div>
        <div class="col-md-4 text-md-end">
            <button class="btn btn-outline-luxury" data-bs-toggle="modal" data-bs-target="#filterModal">
                Filter Experience
            </button>
        </div>
    </div>

    <div class="row g-4">
        @foreach($vacacions as $vacacion)
        <div class="col-md-4">
            <div class="card card-luxury">
                <div class="card-img-wrapper">
                    <img src="{{ $vacacion->url }}" class="card-img-top" alt="{{ $vacacion->titulo }}">
                </div>
                <div class="card-body">
                    <span class="card-meta">{{ $vacacion->pais }} • {{ $vacacion->tipo->nombre ?? 'Experience' }}</span>
                    <h5 class="card-title">{{ $vacacion->titulo }}</h5>
                    <p class="text-muted mb-4">{{ Str::limit($vacacion->descripcion, 80) }}</p>
                    <div class="d-flex justify-content-between align-items-end mt-auto">
                        <div>
                            <small class="text-muted d-block">From</small>
                            <span class="price-tag">${{ number_format($vacacion->precio_por_persona) }}</span>
                        </div>
                        <a href="{{ route('vacaciones.show', $vacacion->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $vacacions->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

    <!-- Testimonials -->
    <div class="py-5 mt-5 border-top">
        <div class="text-center mb-5">
            <span class="text-muted text-uppercase ls-1">Testimonials</span>
            <h2 class="display-5 font-serif">What our travelers say</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-luxury p-4 text-center h-100">
                    <div class="mb-3 text-warning">★★★★★</div>
                    <p class="fst-italic mb-4">"A transformative experience. Every detail was perfect."</p>
                    <h6 class="font-serif fw-bold">— Carlos M., Madrid</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-luxury p-4 text-center h-100">
                    <div class="mb-3 text-warning">★★★★★</div>
                    <p class="fst-italic mb-4">"The best trip of our lives. Luxury Escapes redefined luxury."</p>
                    <h6 class="font-serif fw-bold">— Ana & Pedro, Barcelona</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-luxury p-4 text-center h-100">
                    <div class="mb-3 text-warning">★★★★★</div>
                    <p class="fst-italic mb-4">"From booking to return, everything was impeccable. We will repeat for sure."</p>
                    <h6 class="font-serif fw-bold">— Sofia L., Valencia</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->
    <div class="bg-primary text-white p-5 rounded-3 mt-5 position-relative overflow-hidden">
        <div class="position-relative z-1 text-center">
            <h2 class="font-serif mb-3">Join the Exclusive Club</h2>
            <p class="lead mb-4 fw-light">Receive invitations to secret destinations and limited offers.</p>
            <form class="row justify-content-center g-2">
                <div class="col-md-5">
                    <input type="email" class="form-control py-3 rounded-0 border-0" placeholder="Your email address">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-luxury w-100 py-3">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Filter Modal (Simple & Clean) -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title font-serif">Refine Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('vacaciones.index') }}" method="get">
            <div class="mb-4">
                <label class="form-label text-uppercase text-muted small">Experience Type</label>
                <select name="id_tipo" class="form-select">
                    <option value="">All Experiences</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id }}" {{ request('id_tipo') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Add other filters similarly styled -->
            <button type="submit" class="btn btn-luxury w-100">Apply Filters</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
