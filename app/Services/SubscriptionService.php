<?php

namespace App\Services;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubscriptionService
{
    /**
     * Get all subscriptions in descending order of created date.
     *
     * @return Collection<int, Subscription>
     */
    public function getSubscriptions(): Collection
    {
        return Subscription::with(['creater_admin'])->latest()->get();
    }

    public function statusChange(Subscription $subscription): bool
    {
        $subscription->status = $subscription->status == Subscription::STATUS_ACTIVE ? Subscription::STATUS_DEACTIVE : Subscription::STATUS_ACTIVE;
        return $subscription->save();
    }


    public function getDetails(Subscription $subscription): Subscription
    {
        // $subscription->creating_time = date('Y-m-d H:i:s', strtotime($subscription->created_at));
        // $subscription->updating_time = $subscription->updated_at ? date('Y-m-d H:i:s', strtotime($subscription->updated_at)) : null;
        $subscription->load(['creater_admin', 'updater_admin']);
        return $subscription;
    }

    /**
     * Create new subscription
     */
    public function create(array $data): Subscription
    {
        $data['slug'] = Str::slug($data['title']);
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }
        $data['created_by'] = admin()->id;
        return Subscription::create($data);
    }

    /**
     * Update existing subscription
     */
    public function update(Subscription $subscription, array $data): bool
    {
        if (isset($data['image'])) {
            // Delete old image if exists
            if ($subscription->image) {
                $this->deleteImage($subscription->image);
            } else {
                $data['image'] = $this->uploadImage($data['image']);
            }
        }
        $data['updated_by'] = admin()->id;
        return $subscription->update($data);
    }

    /**
     * Delete subscription (soft delete)
     */
    public function delete(Subscription $subscription): ?bool
    {
        $subscription->deleted_by = admin()->id;
        return $subscription->delete();
    }

    /**
     * Force delete subscription
     */
    public function forceDelete(Subscription $subscription): ?bool
    {
        if ($subscription->image) {
            $this->deleteImage($subscription->image);
        }
        return $subscription->forceDelete();
    }

    protected function uploadImage($image): string
    {
        $path = $image->store('subscriptions', 'public');
        return $path;
    }

    /**
     * Delete image from storage
     */
    protected function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
