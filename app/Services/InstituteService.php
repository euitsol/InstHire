<?php

namespace App\Services;

use App\Models\Institute;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class InstituteService
{
    // public function getInstitutes(): Collection
    // {
    //     return Institute::latest()->get();
    // }
    // public function store($data)
    // {
    //     $data['valid_to'] = Carbon::now()->addMonths(1);
    //     return Institute::create($data);
    // }

    // public function update($institute, $data)
    // {
    //     $institute->update($data);
    //     return $institute;
    // }


    /**
     * Get list of institute
     */
    public function getInstitutes(): Collection
    {
        return Institute::with(['subscriptions'])->latest()->get();
    }

    public function statusChange(Institute $institute): bool
    {
        $institute->status = $institute->status == Institute::STATUS_ACTIVE ? Institute::STATUS_DEACTIVE : Institute::STATUS_ACTIVE;
        return $institute->save();
    }

    public function getDetails(Institute $institute): Institute
    {
        $institute->modify_image = $institute->image ? asset('storage/' . $institute->image) : strtoupper(substr($institute->name, 0, 1));
        $institute->creating_time = date('Y-m-d H:i:s', strtotime($institute->created_at));
        $institute->updating_time = $institute->updated_at ? date('Y-m-d H:i:s', strtotime($institute->updated_at)) : null;
        $institute->status_labels = Institute::getStatusLabels();
        return $institute;
    }

    /**
     * Create new institute
     */
    public function create(array $data): Institute
    {
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }
        return Institute::create($data);
    }

    /**
     * Update existing institute
     */
    public function update(Institute $institute, array $data): bool
    {
        if (isset($data['image'])) {
            // Delete old image if exists
            if ($institute->image) {
                $this->deleteImage($institute->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        $data['password'] = !empty($data['password']) ? $data['password']: $institute->password;
        return $institute->update($data);
    }

    /**
     * Delete institute (soft delete)
     */
    public function delete(Institute $institute): ?bool
    {
        return $institute->delete();
    }

    /**
     * Force delete institute
     */
    public function forceDelete(Institute $institute): ?bool
    {
        if ($institute->image) {
            $this->deleteImage($institute->image);
        }
        return $institute->forceDelete();
    }

    /**
     * Upload image to storage
     */
    protected function uploadImage($image): string
    {
        $path = $image->store('institute/profile', 'public');
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
