@extends('app.bootstrap.template')

@section('title', 'Edit Experience | Luxury Escapes')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-luxury border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="card-title font-serif mb-0">Edit Experience: {{ $vacacion->titulo }}</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('vacaciones.update', $vacacion->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="titulo" class="form-label text-uppercase small ls-1">Title</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $vacacion->titulo) }}" required>
                                @error('titulo') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pais" class="form-label text-uppercase small ls-1">Country</label>
                                <input type="text" class="form-control" id="pais" name="pais" value="{{ old('pais', $vacacion->pais) }}" required>
                                @error('pais') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="ciudad" class="form-label text-uppercase small ls-1">City</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ old('ciudad', $vacacion->ciudad) }}" required>
                                @error('ciudad') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="id_tipo" class="form-label text-uppercase small ls-1">Type</label>
                                <select class="form-select" id="id_tipo" name="id_tipo" required>
                                    <option value="">Select Type...</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('id_tipo', $vacacion->id_tipo) == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('id_tipo') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="precio_por_persona" class="form-label text-uppercase small ls-1">Price per Person (€)</label>
                                <input type="number" step="0.01" class="form-control" id="precio_por_persona" name="precio_por_persona" value="{{ old('precio_por_persona', $vacacion->precio_por_persona) }}" required>
                                @error('precio_por_persona') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="duracion_dias" class="form-label text-uppercase small ls-1">Duration (Days)</label>
                                <input type="number" class="form-control" id="duracion_dias" name="duracion_dias" value="{{ old('duracion_dias', $vacacion->duracion_dias) }}" required>
                                @error('duracion_dias') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label text-uppercase small ls-1">Description</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $vacacion->descripcion) }}</textarea>
                            @error('descripcion') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="itinerario" class="form-label text-uppercase small ls-1">Itinerary</label>
                            <textarea class="form-control" id="itinerario" name="itinerario" rows="6" required>{{ old('itinerario', $vacacion->itinerario) }}</textarea>
                             <div class="form-text">Describe the day-by-day plan.</div>
                            @error('itinerario') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="foto" class="form-label text-uppercase small ls-1">Cover Image</label>
                            @if($vacacion->foto)
                                <div class="mb-2">
                                    <img src="{{ $vacacion->url }}" alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="delete_image" id="delete_image" value="1">
                                    <label class="form-check-label text-muted small" for="delete_image">
                                        Delete current image
                                    </label>
                                </div>
                            @endif
                            <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
                            @error('foto') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('vacaciones.admin_index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-luxury">Update Experience</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
