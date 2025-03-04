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
        Subscription::create([
            'title' => 'Basic',
            'slug' => 'basic',
            'price' => 1000,
            'status' => Subscription::STATUS_ACTIVE,
            'validity' => 30
        ]);
        Subscription::create([
            'title' => 'Premium',
            'slug' => 'premium',
            'price' => 3000,
            'status' => Subscription::STATUS_ACTIVE,
            'validity' => 90
        ]);
        Subscription::create([
            'title' => 'Enterprise',
            'slug' => 'enterprise',
            'price' => 5000,
            'status' => Subscription::STATUS_ACTIVE,
            'validity' => 180
        ]);
        Subscription::create([
            'title' => 'Premium Plus',
            'slug' => 'premium-plus',
            'price' => 10000,
            'status' => Subscription::STATUS_ACTIVE,
            'validity' => 365
        ]);
    }
}
