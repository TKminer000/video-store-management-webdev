<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        // Reset all tapes to available first
        DB::table('tape')->update(['status' => 'available']);
        DB::table('rentals')->insert([
            // Inception (movie 2, tapes 3) - rented multiple times = high demand
            ['tape_number' => 3, 'user_id' => 1, 'rented_at' => '2026-06-01 10:00:00', 'returned_at' => '2026-06-03 14:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 3, 'user_id' => 2, 'rented_at' => '2026-06-05 09:00:00', 'returned_at' => '2026-06-07 11:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 3, 'user_id' => 1, 'rented_at' => '2026-06-10 08:00:00', 'returned_at' => '2026-06-12 16:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 3, 'user_id' => 2, 'rented_at' => '2026-06-15 10:00:00', 'returned_at' => '2026-06-17 13:00:00', 'created_at' => now(), 'updated_at' => now()],

            // The Dark Knight (movie 7, tapes 9,10) - high demand
            ['tape_number' => 9, 'user_id' => 1, 'rented_at' => '2026-06-02 11:00:00', 'returned_at' => '2026-06-04 15:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 9, 'user_id' => 2, 'rented_at' => '2026-06-06 09:00:00', 'returned_at' => '2026-06-08 12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 10, 'user_id' => 1, 'rented_at' => '2026-06-11 10:00:00', 'returned_at' => '2026-06-13 14:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 10, 'user_id' => 2, 'rented_at' => '2026-06-16 08:00:00', 'returned_at' => '2026-06-18 16:00:00', 'created_at' => now(), 'updated_at' => now()],

            // The Matrix (movie 1, tapes 1,2) - medium demand
            ['tape_number' => 1, 'user_id' => 1, 'rented_at' => '2026-06-03 10:00:00', 'returned_at' => '2026-06-05 14:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 1, 'user_id' => 2, 'rented_at' => '2026-06-08 09:00:00', 'returned_at' => '2026-06-10 11:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 2, 'user_id' => 1, 'rented_at' => '2026-06-13 10:00:00', 'returned_at' => '2026-06-15 14:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Interstellar (movie 5, tapes 6,7) - medium demand
            ['tape_number' => 6, 'user_id' => 1, 'rented_at' => '2026-06-04 10:00:00', 'returned_at' => '2026-06-06 14:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 6, 'user_id' => 2, 'rented_at' => '2026-06-09 09:00:00', 'returned_at' => '2026-06-11 11:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 7, 'user_id' => 1, 'rented_at' => '2026-06-14 10:00:00', 'returned_at' => '2026-06-16 14:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Pulp Fiction (movie 6, tape 8)
            ['tape_number' => 8, 'user_id' => 1, 'rented_at' => '2026-06-05 10:00:00', 'returned_at' => '2026-06-07 14:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['tape_number' => 8, 'user_id' => 2, 'rented_at' => '2026-06-12 09:00:00', 'returned_at' => '2026-06-14 11:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Forrest Gump (movie 8, tape 11) - low demand
            ['tape_number' => 11, 'user_id' => 1, 'rented_at' => '2026-06-06 10:00:00', 'returned_at' => '2026-06-08 14:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Toy Story (movie 4, tape 5) - low demand
            ['tape_number' => 5, 'user_id' => 2, 'rented_at' => '2026-06-07 10:00:00', 'returned_at' => '2026-06-09 14:00:00', 'created_at' => now(), 'updated_at' => now()],

            // The Godfather (movie 3, tape 4)
            ['tape_number' => 4, 'user_id' => 2, 'rented_at' => '2026-06-10 10:00:00', 'returned_at' => '2026-06-12 14:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Star Wars (movie 9, tape 12) - currently rented (no return)
            ['tape_number' => 12, 'user_id' => 1, 'rented_at' => '2026-06-18 10:00:00', 'returned_at' => null, 'created_at' => now(), 'updated_at' => now()],

            // The Shining (movie 10, tape 13) - currently rented
            ['tape_number' => 13, 'user_id' => 2, 'rented_at' => '2026-06-19 09:00:00', 'returned_at' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sync tape status for currently rented tapes
        DB::table('tape')->whereIn('tape_number', [12, 13])->update(['status' => 'rented']);
    }
}
