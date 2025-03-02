<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Institute;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Disable foreign key checks to allow truncating
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');

         // Clear existing employees
         Department::truncate();

         // Re-enable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');

         // Get all institute IDs
         $instituteIds = Institute::pluck('id')->toArray();

         $dep_names = ['CSE Department', 'EEE Department', 'IT Department'];

         // Create employees for each institute
         foreach ($instituteIds as $instituteId) {
             // Create 3 employees per institute
             for ($i = 0; $i < count($dep_names); $i++) {
                Department::create([
                     'institute_id' => $instituteId,
                     'name' => $dep_names[$i],
                 ]);
             }
         }
    }
}
