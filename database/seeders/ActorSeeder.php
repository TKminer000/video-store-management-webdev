<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('actor')->insert([
            ['actor_id' => 1, 'name' => 'Keanu Reeves'],
            ['actor_id' => 2, 'name' => 'Leonardo DiCaprio'],
            ['actor_id' => 3, 'name' => 'Marlon Brando'],
            ['actor_id' => 4, 'name' => 'Tom Hanks'],
            ['actor_id' => 5, 'name' => 'Matthew McConaughey'],
            ['actor_id' => 6, 'name' => 'Samuel L. Jackson'],
            ['actor_id' => 7, 'name' => 'Christian Bale'],
            ['actor_id' => 8, 'name' => 'Jack Nicholson'],
        ]);
    }
}
