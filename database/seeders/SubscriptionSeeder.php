<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::create([
            'title' => 'Free',
            'slug' => 'free',
            'price' => 0,
            'status' => Subscription::STATUS_ACTIVE,
            'validity' => 7
        ]);
    }
}
