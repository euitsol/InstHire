<?php

namespace Database\Seeders;

use App\Models\InstituteSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstituteSession::create([
            'institute_id' => 1,
            'name' => 'Session 2025',
            'status' => InstituteSession::STATUS_ACTIVE,
        ]);
    }
}
