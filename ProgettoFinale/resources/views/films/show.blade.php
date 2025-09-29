@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $film->title }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Descrizione:</strong> {{ $film->description }}</p>
                    <p><strong>Regista:</strong> {{ $film->director }}</p>
                    <p><strong>Anno:</strong> {{ $film->release_year }}</p>
                    <p><strong>Durata:</strong> {{ $film->duration_minutes }} minuti</p>
                    
                    @if($film->rating)
                        <p><strong>Voto:</strong> {{ $film->rating }}</p>
                    @endif
                    
                    @if($film->poster_url)
                        <p><strong>Poster:</strong> <a href="{{ $film->poster_url }}" target="_blank">Visualizza</a></p>
                    @endif
                    
                    <p><strong>Generi:</strong>
                        @foreach($film->genres as $genre)
                            <span class="badge bg-secondary">{{ $genre->name }}</span>
                        @endforeach
                    </p>
                    
                    <div class="mt-3">
                        <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning">Modifica</a>
                        <a href="{{ route('films.index') }}" class="btn btn-secondary">Torna alla Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection