<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // Recupero tutti i generi disponibili
        $genres = Genre::all();
        
        // Creo 20 film casuali
        for ($i = 0; $i < 20; $i++) {
            $film = Film::create([
                'title' => $faker->sentence(3, false), // Titolo casuale di 3 parole
                'description' => $faker->paragraph(4), // Descrizione di 4 frasi
                'release_year' => $faker->numberBetween(1980, 2024), // Anno tra 1980-2024
                'duration_minutes' => $faker->numberBetween(80, 180), // Durata 80-180 min
                'director' => $faker->name(), // Nome regista casuale
                'rating' => $faker->randomFloat(1, 1, 10), // Voto da 1.0 a 10.0
                'poster_url' => $faker->imageUrl(300, 450, 'movies'), // URL poster casuale
            ]);
            
            // Assegno 1-3 generi casuali a ogni film
            $randomGenres = $genres->random($faker->numberBetween(1, 3));
            $film->genres()->attach($randomGenres->pluck('id'));
        }
    }
}
