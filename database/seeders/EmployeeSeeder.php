<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Institute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing employees
        Employee::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Get all institute IDs
        $instituteIds = Institute::pluck('id')->toArray();

        // Create employees for each institute
        foreach ($instituteIds as $instituteId) {
            // Create 3 employees per institute
            for ($i = 1; $i <= 3; $i++) {
                Employee::create([
                    'id' => $i.$instituteId,
                    'name' => "Employee $i of Institute $instituteId",
                    'email' => "employee{$i}_institute{$instituteId}@example.com",
                    'password' => Hash::make('password123'),
                    'phone' => "01712345" . str_pad($instituteId * 10 + $i, 3, '0', STR_PAD_LEFT),
                    'gender' => rand(1, 2), // 1 for male, 2 for female
                    'status' => 1, // Active
                    'verifier_type' => 'App\\Models\\Institute',
                    'verifier_id' => $instituteId,
                ]);
            }
        }
    }
}
