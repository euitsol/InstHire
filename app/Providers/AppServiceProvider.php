<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\InstituteSubscription;
use App\Observers\InstituteSubscriptionObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        InstituteSubscription::observe(InstituteSubscriptionObserver::class);
        Schema::defaultStringLength(191);
    }
}