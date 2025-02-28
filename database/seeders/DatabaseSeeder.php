<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            SubscriptionSeeder::class,
            InstituteSeeder::class,
            SessionSeeder::class,
            CategorySeeder::class,
            DepartmentSeeder::class,
            JobFairStallOptionSeeder::class,
            JobCategorySeeder::class,
            JobPostSeeder::class,
        ]);
    }
}
