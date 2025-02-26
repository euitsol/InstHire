<?php

namespace Database\Seeders;

use App\Models\JobFairStallOption;
use Illuminate\Database\Seeder;

class JobFairStallOptionSeeder extends Seeder
{
    public function run(): void
    {
        $stallOptions = [
            [
                'institute_id' => 1, // Replace with actual institute ID
                'stall_size' => 'Small (10x10)',
                'maximum_representative' => 2,
                'description' => 'Small stall suitable for startups and small companies',
                'status' => true
            ],
            [
                'institute_id' => 1, // Replace with actual institute ID
                'stall_size' => 'Medium (15x15)',
                'maximum_representative' => 4,
                'description' => 'Medium stall suitable for mid-sized companies',
                'status' => true
            ],
            [
                'institute_id' => 1, // Replace with actual institute ID
                'stall_size' => 'Large (20x20)',
                'maximum_representative' => 6,
                'description' => 'Large stall suitable for big corporations',
                'status' => true
            ]
        ];

        foreach ($stallOptions as $option) {
            JobFairStallOption::create($option);
        }
    }
}
