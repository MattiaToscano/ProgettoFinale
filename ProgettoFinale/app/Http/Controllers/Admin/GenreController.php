<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    //Lista di tutti i generi
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    
    public function create()
    {
        return view('genres.create');
    }

    //Salva nuovo genere
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        
        Genre::create($request->all());
        return redirect()->route('genres.index');
    }

    //Mostra singolo genere
    public function show(Genre $genre)
    {
        return view('genres.show', compact('genre'));
    }

    //Modifica
    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

   //Aggiorna
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $genre->update($request->all());
        return redirect()->route('genres.index');
    }

    //Elimina
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index');
    }
}
