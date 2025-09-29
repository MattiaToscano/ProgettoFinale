@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Lista Film</h1>
            
            <!-- Bottone per creare nuovo film -->
            <a href="{{ route('films.create') }}" class="btn btn-primary mb-3">
                Aggiungi Nuovo Film
            </a>
            
            <!-- Tabella con lista film -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titolo</th>
                            <th>Regista</th>
                            <th>Anno</th>
                            <th>Durata</th>
                            <th>Generi</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($films as $film)
                            <tr>
                                <td>{{ $film->id }}</td>
                                <td>{{ $film->title }}</td>
                                <td>{{ $film->director }}</td>
                                <td>{{ $film->release_year }}</td>
                                <td>{{ $film->duration_minutes }} min</td>
                                <td>
                                    @foreach($film->genres as $genre)
                                        <span class="badge bg-secondary">{{ $genre->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('films.show', $film->id) }}" class="btn btn-sm btn-info">Vedi</a>
                                    <a href="{{ route('films.edit', $film->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                    
                                    <form action="{{ route('films.destroy', $film->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Sei sicuro?')">
                                            Elimina
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection