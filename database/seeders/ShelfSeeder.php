<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShelfSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shelf')->insert([
            ['shelf_id' => 1, 'category' => 'Action'],
            ['shelf_id' => 2, 'category' => 'Comedy'],
            ['shelf_id' => 3, 'category' => 'Drama'],
            ['shelf_id' => 4, 'category' => 'SciFi'],
            ['shelf_id' => 5, 'category' => 'Suspense'],
            ['shelf_id' => 6, 'category' => 'Classics'],
            ['shelf_id' => 7, 'category' => 'New Releases'],
        ]);
    }
}
