<?php

namespace App\Services;

use App\Models\Institute;
use App\Models\InstituteSubscription;
use App\Models\Subscription;
use Carbon\Carbon;

class InstituteSubscriptionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get all institute subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return InstituteSubscription::with(['institute', 'subscription', 'creater'])->latest()->get();
    }

    public function getInstCurrentSubs($inst_id){
        return InstituteSubscription::with(['institute', 'subscription', 'creater'])->where('institute_id', $inst_id)->where('status', 1)->first();
    }

    /**
     * Create a new institute subscription.
     *
     * @param array $data
     * @return InstituteSubscription
     */
    public function create(array $data): InstituteSubscription
    {
        // Set previous subscriptions as 'previous'
        InstituteSubscription::where('institute_id', $data['institute_id'])
            ->where('status', 1) // current
            ->update(['status' => 0]); // previous

        // Create new subscription with 'current' status
        $data['status'] = 1;
        $subscription = Subscription::findOrFail($data['subscription_id']);

        $valid_to = Carbon::now()->addDays($subscription->validity);

        Institute::where('id', $data['institute_id'])->update(['valid_to' => $valid_to]);
        return InstituteSubscription::create($data);
    }

    /**
     * Update an institute subscription.
     *
     * @param InstituteSubscription $instituteSubscription
     * @param array $data
     * @return InstituteSubscription
     */
    public function update(InstituteSubscription $instituteSubscription, array $data): InstituteSubscription
    {
        $instituteSubscription->update($data);
        return $instituteSubscription;
    }

    /**
     * Delete an institute subscription.
     *
     * @param InstituteSubscription $instituteSubscription
     * @return bool|null
     */
    public function delete(InstituteSubscription $instituteSubscription): ?bool
    {
        $instituteSubscription->deleter_id = admin()->id;
        $instituteSubscription->deleter_type = get_class(admin());
        return $instituteSubscription->delete();
    }
}
