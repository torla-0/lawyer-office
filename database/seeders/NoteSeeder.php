<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(storage_path('app/mock-data/mock-data-note.csv'), 'r');

        // Skip header row
        fgetcsv($csvFile);

        while (($data = fgetcsv($csvFile)) !== false) {
            // Create a note record
            DB::table('notes')->insert([
                'title' => $data[0],
                'content' => $data[1],
                'legal_case_id' => $data[2],
                // Add other columns as needed
            ]);
        }

        fclose($csvFile);
    }
}
