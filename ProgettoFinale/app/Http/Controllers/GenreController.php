<?php

namespace App\Http\Controllers;

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
    public function show(string $id)
    {
        $genre = Genre::find($id);
        return view('genres.show', compact('genre'));
    }

    //Modifica
    public function edit(string $id)
    {
        $genre = Genre::find($id);
        return view('genres.edit', compact('genre'));
    }

   //Aggiorna
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $genre = Genre::find($id);
        $genre->update($request->all());
        return redirect()->route('genres.index');
    }

    //Elimina
    public function destroy(string $id)
    {
        $genre = Genre::find($id);
        $genre->delete();
        return redirect()->route('genres.index');
    }
}
