<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    //Recupera tutti i film con i loro generi
    public function index()
    {
        $films = Film::with('genres')->get();

        //Restituisce la view con i dati
        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Recupera tutti i generi per popolare la select nel form
        $genres = Genre::all();

        //restituisce la view del form di creazion
        return view('films.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validazioni
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'release_year' => 'required',
            'duration_minutes' => 'required',
            'director' => 'required'
        ]);

        //Creo il film
        $film = Film::create($request->all());

        //Se ci sono generi selezionati, li associa
        if($request->has('genres')){
            $film->genres()->attach($request->genres);
        }

        //Torna alla lista dei film
        return redirect()->route('films.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Trova il film con i suoi generi
        $film = Film::find($id);

        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $film = Film::find($id);
        $genres = Genre::all();

        return view('films.edit', compact('film', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'release_year' => 'required',
            'duration_minutes' => 'required',
            'director' => 'required',
        ]);
        $film = Film::find($id);
        $film->update($request->all());

        //Aggiorna i generi
        if($request->has('genres')){
            $film->genres()->sync($request->genres);
        }
        return redirect()->route('films.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $film = Film::find($id);
        $film->delete();

        return redirect()->route('films.index');
    }
}
