<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Azione', 'description' => 'Film ricchi di scene d\'azione e avventura'],
            ['name' => 'Commedia', 'description' => 'Film divertenti e leggeri'],
            ['name' => 'Horror', 'description' => 'Film di paura e suspense'],
            ['name' => 'Sci-Fi', 'description' => 'Film di fantascienza'],
            ['name' => 'Drama', 'description' => 'Film drammatici e intensi'],
            ['name' => 'Fantasy', 'description' => 'Film fantastici e magici'],
            ['name' => 'Thriller', 'description' => 'Film di suspense e tensione'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
