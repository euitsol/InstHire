<?php

namespace Database\Seeders;

use App\Models\Institute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate the institutes table
        Institute::truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create institutes
        $institutes = [
            [
                'id' => 1,
                'name' => 'Dhaka University',
                'slug' => 'dhaka-university',
                'email' => 'du@example.com',
                'password' => Hash::make('password123'),
                'responsible_person_name' => 'John Doe',
                'responsible_person_phone' => '01712345678',
            ],
            [
                'id' => 2,
                'name' => 'BUET',
                'slug' => 'buet',
                'email' => 'buet@example.com',
                'password' => Hash::make('password123'),
                'responsible_person_name' => 'Jane Smith',
                'responsible_person_phone' => '01812345678',
            ],
            [
                'id' => 3,
                'name' => 'North South University',
                'slug' => 'north-south-university',
                'email' => 'nsu@example.com',
                'password' => Hash::make('password123'),
                'responsible_person_name' => 'Robert Johnson',
                'responsible_person_phone' => '01912345678',
            ],
            [
                'id' => 4,
                'name' => 'BRAC University',
                'slug' => 'brac-university',
                'email' => 'bracu@example.com',
                'password' => Hash::make('password123'),
                'responsible_person_name' => 'Sarah Williams',
                'responsible_person_phone' => '01612345678',
            ],
            [
                'id' => 5,
                'name' => 'East West University',
                'slug' => 'east-west-university',
                'email' => 'ewu@example.com',
                'password' => Hash::make('password123'),
                'responsible_person_name' => 'Michael Brown',
                'responsible_person_phone' => '01512345678',
            ],
        ];

        // Insert institutes
        foreach ($institutes as $institute) {
            Institute::create($institute);
        }
    }
}
