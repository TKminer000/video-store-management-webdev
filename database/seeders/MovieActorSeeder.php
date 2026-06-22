<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieActorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('movie_actor')->insert([
            ['movie_id' => 1, 'actor_id' => 1],
            ['movie_id' => 2, 'actor_id' => 2],
            ['movie_id' => 3, 'actor_id' => 3],
            ['movie_id' => 4, 'actor_id' => 4],
            ['movie_id' => 5, 'actor_id' => 5],
            ['movie_id' => 6, 'actor_id' => 6],
            ['movie_id' => 7, 'actor_id' => 7],
            ['movie_id' => 8, 'actor_id' => 4],
            ['movie_id' => 9, 'actor_id' => 3],
            ['movie_id' => 10, 'actor_id' => 8],
        ]);
    }
}
