<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'User',
            'email' => 'user@dev.com',
            'password' => 'user@dev.com',
        ]);
        User::create([
            'name' => 'Test User',
            'email' => 'user1@dev.com',
            'password' => 'user1@dev.com',
        ]);
    }
}
