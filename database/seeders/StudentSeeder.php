<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Institute;
use App\Models\InstituteSession;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing employees
        Student::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Get all institute IDs
        $instituteIds = Institute::pluck('id')->toArray();

        foreach ($instituteIds as $instituteId) {
            $departments = Department::where('institute_id', $instituteId)->get();
            $sessions = InstituteSession::where('institute_id', $instituteId)->get();

            $combinations = $departments->crossJoin($sessions);

            $studentsToCreate = [];

            foreach ($combinations as $key => [$department, $session]) {
                    $studentsToCreate[] = [
                        'institute_id' => $instituteId,
                        'department_id' => $department->id,
                        'session_id' => $session->id,
                        'name' => 'Student',
                        'email' => 'student' . $key+1 . '_' . $department->id . '_' . $session->id . '_' . $instituteId . '@institute.com',
                        'password' => Hash::make('password'),
                    ];
            }

            Student::insert($studentsToCreate);
        }
    }
}
