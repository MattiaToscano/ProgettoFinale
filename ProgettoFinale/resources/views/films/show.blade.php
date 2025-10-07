@extends('layouts.films')

@section('content')
<!-- Header della pagina -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Dettaglio Film</h1>
                <p class="mb-0">Informazioni complete su "{{ $film->title }}"</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('films.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Torna alla Lista
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
                <div class="row">
                    <!-- Poster a sinistra -->
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        @if($film->poster_path)
                            <img src="{{ asset('storage/' . $film->poster_path) }}" 
                                 alt="Poster di {{ $film->title }}" 
                                 class="img-fluid rounded shadow"
                                 style="max-height: 400px;">
                        @else
                            <div class="bg-light p-5 rounded text-muted">
                                <i class="fas fa-film fa-5x mb-3"></i>
                                <p class="mb-0">Nessun poster disponibile</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Informazioni a destra -->
                    <div class="col-md-8">
                        <!-- Titolo e Anno -->
                        <div class="d-flex align-items-center mb-3">
                            <h1 class="mb-0 me-3">{{ $film->title }}</h1>
                            <span class="badge bg-primary fs-6">{{ $film->release_year }}</span>
                        </div>
                        
                        <!-- Tabella informazioni -->
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-muted" style="width: 150px;">Regista:</td>
                                        <td>{{ $film->director }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">Durata:</td>
                                        <td>{{ $film->duration_minutes }} minuti</td>
                                    </tr>
                                    @if($film->rating)
                                    <tr>
                                        <td class="fw-bold text-muted">Voto:</td>
                                        <td>
                                            <span class="badge bg-warning text-dark">{{ $film->rating }}/10</span>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="fw-bold text-muted">Generi:</td>
                                        <td>
                                            @forelse($film->genres as $genre)
                                                <span class="badge bg-light text-dark me-1">{{ $genre->name }}</span>
                                            @empty
                                                <span class="text-muted">Nessun genere assegnato</span>
                                            @endforelse
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Descrizione -->
                        <div class="mt-4">
                            <h5 class="text-primary">
                                <i class="fas fa-info-circle me-2"></i>Descrizione
                            </h5>
                            <div class="bg-light p-3 rounded">
                                <p class="mb-0">{{ $film->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bottoni di azione -->
                <hr class="my-4">
                <div class="text-center">
                    <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Modifica Film
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection