<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class AdminService
{
    /**
     * Get list of admins
     */
    public function getAdmins(): Collection
    {
        return Admin::latest()->get();
    }

    public function statusChange(Admin $admin): bool
    {
        $admin->status = $admin->status == Admin::STATUS_ACTIVE ? Admin::STATUS_DEACTIVE : Admin::STATUS_ACTIVE;
        return $admin->save();
    }


    public function getDetails(Admin $admin): Admin
    {
        $admin->modify_image = $admin->image ? asset('storage/' . $admin->image) : strtoupper(substr($admin->name, 0, 1));
        $admin->creating_time = date('Y-m-d H:i:s', strtotime($admin->created_at));
        $admin->updating_time = $admin->updated_at ? date('Y-m-d H:i:s', strtotime($admin->updated_at)) : null;
        $admin->status_labels = Admin::getStatusLabels();
        $admin->gender_labels = Admin::getGenderLabels();
        return $admin;
    }

    /**
     * Create new admin
     */
    public function createAdmin(array $data): Admin
    {
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return Admin::create($data);
    }

    /**
     * Update existing admin
     */
    public function updateAdmin(Admin $admin, array $data): bool
    {
        if (isset($data['image'])) {
            // Delete old image if exists
            if ($admin->image) {
                $this->deleteImage($admin->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }
        return $admin->update($data);
    }

    /**
     * Delete admin (soft delete)
     */
    public function deleteAdmin(Admin $admin): ?bool
    {
        return $admin->delete();
    }

    /**
     * Force delete admin
     */
    public function forceDeleteAdmin(Admin $admin): ?bool
    {
        if ($admin->image) {
            $this->deleteImage($admin->image);
        }
        return $admin->forceDelete();
    }

    /**
     * Upload image to storage
     */
    protected function uploadImage($image): string
    {
        $path = $image->store('admin/profile', 'public');
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
