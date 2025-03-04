<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\InstituteSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Disable foreign key checks to allow truncating
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');

         // Clear existing employees
         InstituteSession::truncate();

         // Re-enable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');

         // Get all institute IDs
         $instituteIds = Institute::pluck('id')->toArray();

         // Create employees for each institute
         foreach ($instituteIds as $instituteId) {
             // Create 3 employees per institute
             for ($i = 1; $i <= 3; $i++) {
                InstituteSession::create([
                     'institute_id' => $instituteId,
                     'name' => "Session - 202$i",
                     'status' => InstituteSession::STATUS_ACTIVE,
                 ]);
             }
         }

    }
}
