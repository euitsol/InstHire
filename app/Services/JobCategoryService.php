<?php

namespace App\Services;

use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Collection;

class JobCategoryService
{
    /**
     * Get list of job categories
     */
    public function getJobCategories(): Collection
    {
        return JobCategory::latest()->get();
    }

    /**
     * Change status of job category
     */
    public function statusChange(JobCategory $jobCategory): bool
    {
        $jobCategory->status = $jobCategory->status == JobCategory::STATUS_ACTIVE
            ? JobCategory::STATUS_DEACTIVE
            : JobCategory::STATUS_ACTIVE;
        return $jobCategory->save();
    }

    /**
     * Get job category details
     */
    public function getDetails(JobCategory $jobCategory): JobCategory
    {
        // $jobCategory->creating_time = date('Y-m-d H:i:s', strtotime($jobCategory->created_at));
        // $jobCategory->updating_time = $jobCategory->updated_at
        //     ? date('Y-m-d H:i:s', strtotime($jobCategory->updated_at))
        //     : null;
        // $jobCategory->status_labels = JobCategory::getStatusLabels();
        return $jobCategory;
    }

    /**
     * Create new job category
     */
    public function createJobCategory(array $data): JobCategory
    {
        return JobCategory::create($data);
    }

    /**
     * Update existing job category
     */
    public function updateJobCategory(JobCategory $jobCategory, array $data): bool
    {
        return $jobCategory->update($data);
    }

    /**
     * Delete job category (soft delete)
     */
    public function deleteJobCategory(JobCategory $jobCategory): ?bool
    {
        return $jobCategory->delete();
    }
}
