<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegalCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(storage_path('app/mock-data/mock-data-legal-case.csv'), 'r');

        // Skip header row
        fgetcsv($csvFile);

        while (($data = fgetcsv($csvFile)) !== false) {
            // Create a legal case record
            DB::table('legal_cases')->insert([
                'title' => $data[0],
                'case_type_id' => $data[1],
                'description' => $data[2],
                'user_id' => $data[3],
                'status' => $data[4],
                // Add other columns as needed
            ]);
        }

        fclose($csvFile);
    }
    
}
