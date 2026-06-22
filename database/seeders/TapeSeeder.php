<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TapeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tape')->insert([
            ['tape_number' => 1,  'movie_id' => 1, 'format' => 'VHS',  'status' => 'available'],
            ['tape_number' => 2,  'movie_id' => 1, 'format' => 'Beta', 'status' => 'available'],
            ['tape_number' => 3,  'movie_id' => 2, 'format' => 'VHS',  'status' => 'available'],
            ['tape_number' => 4,  'movie_id' => 3, 'format' => 'VHS',  'status' => 'available'],
            ['tape_number' => 5,  'movie_id' => 4, 'format' => 'Beta', 'status' => 'available'],
            ['tape_number' => 6,  'movie_id' => 5, 'format' => 'VHS',  'status' => 'available'],
            ['tape_number' => 7,  'movie_id' => 5, 'format' => 'Beta', 'status' => 'available'],
            ['tape_number' => 8,  'movie_id' => 6, 'format' => 'VHS',  'status' => 'available'],
            ['tape_number' => 9,  'movie_id' => 7, 'format' => 'VHS',  'status' => 'available'],
            ['tape_number' => 10, 'movie_id' => 7, 'format' => 'Beta', 'status' => 'available'],
            ['tape_number' => 11, 'movie_id' => 8, 'format' => 'VHS',  'status' => 'available'],
            ['tape_number' => 12, 'movie_id' => 9, 'format' => 'VHS',  'status' => 'available'],
            ['tape_number' => 13, 'movie_id' => 10, 'format' => 'Beta', 'status' => 'available'],
        ]);
    }
}
