@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Aggiungi Nuovo Film</h1>
            
            <!-- Form di creazione semplificato -->
            <form action="{{ route('films.store') }}" method="POST" class="card p-4">
                @csrf
                
                <!-- Titolo -->
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo *</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                
                <!-- Descrizione -->
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione *</label>
                    <textarea class="form-control" name="description" rows="4" required></textarea>
                </div>
                
                <!-- Anno -->
                <div class="mb-3">
                    <label for="release_year" class="form-label">Anno di Uscita *</label>
                    <input type="number" class="form-control" name="release_year" required>
                </div>
                
                <!-- Durata -->
                <div class="mb-3">
                    <label for="duration_minutes" class="form-label">Durata (minuti) *</label>
                    <input type="number" class="form-control" name="duration_minutes" required>
                </div>
                
                <!-- Regista -->
                <div class="mb-3">
                    <label for="director" class="form-label">Regista *</label>
                    <input type="text" class="form-control" name="director" required>
                </div>
                
                <!-- Rating (opzionale) -->
                <div class="mb-3">
                    <label for="rating" class="form-label">Voto</label>
                    <input type="number" class="form-control" name="rating">
                </div>
                
                <!-- Poster URL (opzionale) -->
                <div class="mb-3">
                    <label for="poster_url" class="form-label">URL Poster</label>
                    <input type="text" class="form-control" name="poster_url">
                </div>
                
                <!-- Generi -->
                <div class="mb-3">
                    <label class="form-label">Generi</label>
                    @foreach($genres as $genre)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}">
                            <label class="form-check-label">{{ $genre->name }}</label>
                        </div>
                    @endforeach
                </div>
                
                <!-- Bottoni -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('films.index') }}" class="btn btn-secondary">Annulla</a>
                    <button type="submit" class="btn btn-primary">Salva Film</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection