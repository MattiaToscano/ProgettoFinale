<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        //Validazioni semplici
        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'release_year' => 'nullable',
            'duration_minutes' => 'nullable',
            'director' => 'nullable',
            'poster' => 'nullable'
        ]);

        //Creo il film
        $film = Film::create($request->except(['poster']));
        
        // Gestione upload poster
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            
            // Salva usando Storage::disk('public')->put()
            $poster_path = Storage::disk('public')->put('uploads', $file);
            $film->poster_path = $poster_path;
            $film->save();
        }

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
            'title' => 'nullable',
            'description' => 'nullable',
            'release_year' => 'nullable',
            'duration_minutes' => 'nullable',
            'director' => 'nullable',
            'poster' => 'nullable'
        ]);
        
        $film = Film::find($id);
        
        // Gestione upload poster
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            
            // Salva usando Storage::disk('public')->put()
            $poster_path = Storage::disk('public')->put('uploads', $file);
            $film->poster_path = $poster_path;
        }
        
        $film->update($request->except(['poster']));

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

    // =============== METODI PER UPLOAD FILE ===============
    
    // Upload semplice di un poster
    public function uploadPoster(Request $request, $filmId)
    {
        $film = Film::find($filmId);
        $file = $request->file('poster');
        
        // Salva usando Storage::disk('public')->put()
        $poster_path = Storage::disk('public')->put('uploads', $file);
        $film->poster_path = $poster_path;
        $film->save();

        return response()->json([
            'message' => 'Poster caricato!',
            'path' => $poster_path,
            'url' => asset('storage/' . $poster_path)
        ]);
    }

    // Lista file
    public function listFiles()
    {
        $files = Storage::disk('public')->files('uploads');
        return response()->json(['files' => $files]);
    }
}