<?php

namespace App\Observers;

use App\Models\InstituteSubscription;
use App\Models\Payment;

class InstituteSubscriptionObserver
{
    /**
     * Handle the InstituteSubscription "created" event.
     */
    public function created(InstituteSubscription $instituteSubscription): void
    {
        Payment::create([
            'institute_id' => $instituteSubscription->institute_id,
            'institute_subscription_id' => $instituteSubscription->id,
            'amount' => $instituteSubscription->subscription->price,
            'status' => 0,
        ]);
    }
}
