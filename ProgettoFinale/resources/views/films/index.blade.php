@extends('layouts.app')

@section('content')
<!-- Header con classi Bootstrap -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">La Mia Collezione Film</h1>
                <p class="mb-0">Gestisci i tuoi film preferiti</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('films.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Aggiungi Film
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Contenuto principale -->
<div class="bg-white min-vh-100">
    <div class="container py-4">
        <div class="row g-4">
            @forelse($films as $film)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm">
                        <!-- Poster -->
                        @if($film->poster_path)
                            <img src="{{ asset('storage/' . $film->poster_path) }}" 
                                 alt="Poster di {{ $film->title }}" 
                                 class="card-img-top"
                                 style="height: 300px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex flex-column align-items-center justify-content-center text-muted" 
                                 style="height: 300px;">
                                <i class="fas fa-film fa-3x mb-2"></i>
                                <small>Nessun poster</small>
                            </div>
                        @endif
                        
                        <!-- Contenuto card -->
                        <div class="card-body d-flex flex-column">
                            <!-- Titolo e Anno -->
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold">{{ $film->title }}</h5>
                                <span class="badge bg-primary">{{ $film->release_year }}</span>
                            </div>
                            
                            <!-- Informazioni film -->
                            <div class="text-muted small mb-2">
                                <div><strong>Regista:</strong> {{ $film->director }}</div>
                                <div><strong>Durata:</strong> {{ $film->duration_minutes }} min</div>
                                @if($film->rating)
                                    <div><strong>Voto:</strong> {{ $film->rating }}/10</div>
                                @endif
                            </div>
                            
                            <!-- Generi -->
                            <div class="mb-3">
                                <div class="small fw-bold text-muted mb-1">Generi:</div>
                                @forelse($film->genres as $genre)
                                    <span class="badge bg-light text-dark me-1">{{ $genre->name }}</span>
                                @empty
                                    <span class="text-muted small">Nessun genere</span>
                                @endforelse
                            </div>
                            
                            <!-- Descrizione -->
                            <p class="text-muted small mb-3 flex-grow-1">
                                {{ Str::limit($film->description, 120) }}
                            </p>
                            
                            <!-- Bottoni azioni -->
                            <div class="mt-auto">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('films.show', $film->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye me-1"></i>Visualizza
                                    </a>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning btn-sm w-100">
                                                <i class="fas fa-edit me-1"></i>Modifica
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{ route('films.destroy', $film->id) }}" method="POST" class="w-100">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100"
                                                        onclick="return confirm('Sei sicuro di voler eliminare questo film?')">
                                                    <i class="fas fa-trash me-1"></i>Elimina
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Stato vuoto -->
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="text-muted mb-4">
                            <i class="fas fa-film fa-5x"></i>
                        </div>
                        <h3 class="text-muted mb-3">La tua collezione è vuota</h3>
                        <p class="text-muted mb-4">Inizia ad aggiungere i tuoi film preferiti per creare la tua collezione personalizzata!</p>
                        <a href="{{ route('films.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Aggiungi il primo film
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection