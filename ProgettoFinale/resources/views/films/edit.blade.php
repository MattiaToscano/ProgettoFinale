@extends('layouts.films')

@section('content')
<!-- Header della pagina -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Modifica Film</h1>
                <p class="mb-0">Aggiorna i dettagli di "{{ $film->title }}"</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('films.show', $film->id) }}" class="btn btn-outline-light me-2">
                    <i class="fas fa-eye me-2"></i>Visualizza
                </a>
                <a href="{{ route('films.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Lista
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Contenuto principale -->
<div class="bg-white min-vh-100">
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('films.update', $film->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Sezione Informazioni Principali -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>Informazioni Principali
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="title" class="form-label fw-bold">Titolo *</label>
                                    <input type="text" class="form-control" name="title" value="{{ $film->title }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="release_year" class="form-label fw-bold">Anno *</label>
                                    <input type="number" class="form-control" name="release_year" value="{{ $film->release_year }}" min="1900" max="2030" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Descrizione *</label>
                                <textarea class="form-control" name="description" rows="4" required>{{ $film->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sezione Dettagli Tecnici -->
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-cogs me-2"></i>Dettagli Tecnici
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="director" class="form-label fw-bold">Regista *</label>
                                    <input type="text" class="form-control" name="director" value="{{ $film->director }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="duration_minutes" class="form-label fw-bold">Durata (minuti) *</label>
                                    <input type="number" class="form-control" name="duration_minutes" value="{{ $film->duration_minutes }}" min="1" max="600" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="rating" class="form-label fw-bold">Voto (1-10)</label>
                                <input type="number" class="form-control" name="rating" value="{{ $film->rating }}" min="1" max="10" step="0.1">
                                <div class="form-text">Opzionale: inserisci un voto da 1 a 10</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sezione Poster -->
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">
                                <i class="fas fa-image me-2"></i>Poster
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($film->poster_path)
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-center mb-3">
                                        <img src="{{ asset('storage/' . $film->poster_path) }}" 
                                             alt="Poster attuale" 
                                             class="img-fluid rounded shadow"
                                             style="max-height: 200px;">
                                        <div class="mt-2">
                                            <small class="text-muted">Poster attuale</small>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <label for="poster" class="form-label fw-bold">Cambia Poster</label>
                                        <input type="file" class="form-control" name="poster" accept="image/*">
                                        <div class="form-text">Lascia vuoto per mantenere il poster attuale. Formati supportati: JPG, PNG, GIF</div>
                                    </div>
                                </div>
                            @else
                                <label for="poster" class="form-label fw-bold">Aggiungi Poster</label>
                                <input type="file" class="form-control" name="poster" accept="image/*">
                                <div class="form-text">Nessun poster attuale. Formati supportati: JPG, PNG, GIF</div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Sezione Generi -->
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-tags me-2"></i>Generi
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($genres as $genre)
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="genres[]" 
                                                   value="{{ $genre->id }}" 
                                                   id="genre{{ $genre->id }}"
                                                   {{ $film->genres->contains($genre->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genre{{ $genre->id }}">
                                                {{ $genre->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($genres->isEmpty())
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Nessun genere disponibile nel sistema.
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Bottoni di azione -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-save me-2"></i>Aggiorna Film
                        </button>
                        <a href="{{ route('films.show', $film->id) }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times me-2"></i>Annulla
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection