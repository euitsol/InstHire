<?php

namespace App\Services;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionService
{
    /**
     * Get all subscriptions in descending order of created date.
     *
     * @return Collection<int, Subscription>
     */
    public function getSubscriptions(): Collection
    {
        return Subscription::latest()->get();
    }

    public function statusChange(Subscription $subscription): bool
    {
        $subscription->status = $subscription->status == Subscription::STATUS_ACTIVE ? Subscription::STATUS_DEACTIVE : Subscription::STATUS_ACTIVE;
        return $subscription->save();
    }


    public function getDetails(Subscription $subscription): Subscription
    {
        $subscription->creating_time = date('Y-m-d H:i:s', strtotime($subscription->created_at));
        $subscription->updating_time = $subscription->updated_at ? date('Y-m-d H:i:s', strtotime($subscription->updated_at)) : null;
        $subscription->status_labels = Subscription::getStatusLabels();
        return $subscription;
    }

    /**
     * Create new subscription
     */
    public function create(array $data): Subscription
    {
        return Subscription::create($data);
    }

    /**
     * Update existing subscription
     */
    public function update(Subscription $subscription, array $data): bool
    {
        return $subscription->update($data);
    }

    /**
     * Delete subscription (soft delete)
     */
    public function delete(Subscription $subscription): ?bool
    {
        return $subscription->delete();
    }

    /**
     * Force delete subscription
     */
    public function forceDeleteAdmin(Subscription $subscription): ?bool
    {
        return $subscription->forceDelete();
    }
}
