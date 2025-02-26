<?php

namespace Database\Seeders;

use App\Models\Institute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Institute::create([
            'id' => 1,
            'name' => 'Institute',
            'slug' => 'institute',
            'email' => 'institute@dev.com',
            'password' => 'institute@dev.com',
            'responsible_person_name' => 'Institute',
            'responsible_person_phone' => '01234567890',
        ]);
    }
}
