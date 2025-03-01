<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the job_categories table
        JobCategory::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Define categories
        $categories = [
            [
                'id' => 1,
                'title' => 'Information Technology',
                'slug' => 'information-technology',
                'status' => 1
            ],
            [
                'id' => 2,
                'title' => 'Software Development',
                'slug' => 'software-development',
                'status' => 1
            ],
            [
                'id' => 3,
                'title' => 'Data Science & Analytics',
                'slug' => 'data-science-analytics',
                'status' => 1
            ],
            [
                'id' => 4,
                'title' => 'Web Development',
                'slug' => 'web-development',
                'status' => 1
            ],
            [
                'id' => 5,
                'title' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'status' => 1
            ],
            [
                'id' => 6,
                'title' => 'Marketing & Communications',
                'slug' => 'marketing-communications',
                'status' => 1
            ],
            [
                'id' => 7,
                'title' => 'Finance & Accounting',
                'slug' => 'finance-accounting',
                'status' => 1
            ],
            [
                'id' => 8,
                'title' => 'Human Resources',
                'slug' => 'human-resources',
                'status' => 1
            ],
            [
                'id' => 9,
                'title' => 'Sales & Business Development',
                'slug' => 'sales-business-development',
                'status' => 1
            ],
            [
                'id' => 10,
                'title' => 'Engineering',
                'slug' => 'engineering',
                'status' => 1
            ],
            [
                'id' => 11,
                'title' => 'Healthcare & Medical',
                'slug' => 'healthcare-medical',
                'status' => 1
            ],
            [
                'id' => 12,
                'title' => 'Education & Training',
                'slug' => 'education-training',
                'status' => 1
            ],
        ];

        // Insert categories
        foreach ($categories as $category) {
            JobCategory::create($category);
        }
    }
}
