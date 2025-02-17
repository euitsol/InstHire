<?php

namespace App\Services;

use App\Models\InstituteSubscription;

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
        return InstituteSubscription::with(['institute', 'subscription','creater'])->latest()->get();
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
        $data['creater_id'] = admin()->id;
        $data['creater_type'] = get_class(admin());
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
        $data['updater_id'] = admin()->id;
        $data['updater_type'] = get_class(admin());
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
