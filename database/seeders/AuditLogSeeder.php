<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditLogSeeder extends Seeder
{
    public function run(): void
    {
        $logs = [];
        $actions = ['CREATE', 'UPDATE', 'DELETE', 'RENT', 'RETURN'];
        $tables = ['movie', 'actor', 'tape', 'shelf', 'users'];

        for ($i = 0; $i < 30; $i++) {
            $table = $tables[array_rand($tables)];
            $action = $actions[array_rand($actions)];
            $detail = match ($action) {
                'CREATE' => match ($table) {
                    'movie' => 'Added movie: Sample Movie Title',
                    'actor' => 'Added actor: John Doe',
                    'tape' => 'Added tape for movie ID: 1',
                    'shelf' => 'Added shelf: New Shelf',
                    'users' => 'Added user: New User',
                },
                'UPDATE' => match ($table) {
                    'movie' => 'Updated movie ID: ' . rand(1, 10),
                    'actor' => 'Updated actor ID: ' . rand(1, 8),
                    'tape' => 'Updated tape number: ' . rand(1, 13),
                    'shelf' => 'Updated shelf ID: ' . rand(1, 7),
                    'users' => 'Updated user ID: ' . rand(1, 2),
                },
                'DELETE' => match ($table) {
                    'movie' => 'Deleted movie: Old Movie',
                    'actor' => 'Deleted actor: Old Actor',
                    'tape' => 'Deleted tape number: ' . rand(1, 13),
                    'shelf' => 'Deleted shelf: Old Shelf',
                    'users' => 'Deleted user ID: ' . rand(1, 2),
                },
                'RENT' => 'Rented tape number: ' . rand(1, 13),
                'RETURN' => 'Returned tape number: ' . rand(1, 13),
            };

            $date = date('Y-m-d H:i:s', strtotime("-" . ($i * 5 + rand(0, 4)) . " hours"));

            $logs[] = [
                'user_id' => rand(1, 2),
                'action' => $action,
                'table_affected' => $table,
                'details' => $detail,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        DB::table('audit_logs')->insert($logs);
    }
}
