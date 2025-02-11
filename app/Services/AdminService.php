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


    public function getDetails(Admin $admin): Admin
    {
       $admin->image = $admin->image ? '<img src="'. asset('storage/' . $admin->image) .' alt="Profile"
            class="rounded-circle" width="40" height="40">' : '<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
            style="width: 40px; height: 40px;">'. strtoupper(substr($admin->name, 0, 1)).'</div>';
       $admin->creating_time = date('Y-m-d H:i:s', strtotime($admin->created_at));
       $admin->updating_time = $admin->updated_at ? date('Y-m-d H:i:s', strtotime($admin->updated_at)) : null;
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
