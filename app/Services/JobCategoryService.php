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
        return JobCategory::with(['creater_admin'])->latest()->get();
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
        $jobCategory->load(['creater_admin','updater_admin']);
        return $jobCategory;
    }

    /**
     * Create new job category
     */
    public function createJobCategory(array $data): JobCategory
    {
        $data['creater_id'] = admin()->id;
        $data['creater_type'] = get_class(admin());
        return JobCategory::create($data);
    }

    /**
     * Update existing job category
     */
    public function updateJobCategory(JobCategory $jobCategory, array $data): bool
    {
        $data['updater_id'] = admin()->id;
        $data['updater_type'] = get_class(admin());
        return $jobCategory->update($data);
    }

    /**
     * Delete job category (soft delete)
     */
    public function deleteJobCategory(JobCategory $jobCategory): ?bool
    {
        $jobCategory->deleter_id = admin()->id;
        $jobCategory->deleter_type = get_class(admin());
        return $jobCategory->delete();
    }
}
