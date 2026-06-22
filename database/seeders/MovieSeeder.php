<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('movie')->insert([
            ['movie_id' => 1, 'title' => 'The Matrix', 'category' => 'action', 'director' => 'Lana Wachowski', 'year' => 1999],
            ['movie_id' => 2, 'title' => 'Inception', 'category' => 'suspense', 'director' => 'Christopher Nolan', 'year' => 2010],
            ['movie_id' => 3, 'title' => 'The Godfather', 'category' => 'drama', 'director' => 'Francis Ford Coppola', 'year' => 1972],
            ['movie_id' => 4, 'title' => 'Toy Story', 'category' => 'comedy', 'director' => 'John Lasseter', 'year' => 1995],
            ['movie_id' => 5, 'title' => 'Interstellar', 'category' => 'SciFi', 'director' => 'Christopher Nolan', 'year' => 2014],
            ['movie_id' => 6, 'title' => 'Pulp Fiction', 'category' => 'drama', 'director' => 'Quentin Tarantino', 'year' => 1994],
            ['movie_id' => 7, 'title' => 'The Dark Knight', 'category' => 'action', 'director' => 'Christopher Nolan', 'year' => 2008],
            ['movie_id' => 8, 'title' => 'Forrest Gump', 'category' => 'drama', 'director' => 'Robert Zemeckis', 'year' => 1994],
            ['movie_id' => 9, 'title' => 'Star Wars: A New Hope', 'category' => 'SciFi', 'director' => 'George Lucas', 'year' => 1977],
            ['movie_id' => 10, 'title' => 'The Shining', 'category' => 'suspense', 'director' => 'Stanley Kubrick', 'year' => 1980],
        ]);
    }
}
