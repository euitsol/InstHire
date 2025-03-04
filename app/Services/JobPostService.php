<?php

namespace App\Services;

use App\Models\Institute;
use App\Models\JobPost;
use Illuminate\Database\Eloquent\Collection;

class JobPostService
{
    /**
     * Get list of Job Posts
     */
    public function getJobPosts(): Collection
    {
        return JobPost::with(['institute', 'category'])->latest()->get();
    }
    public function getActiveJobPosts(): Collection
    {
        return JobPost::active()->with(['institute', 'category'])->latest()->get();
    }

    public function getInstituteJobPosts($institute_id): Collection
    {
        return JobPost::with(['institute', 'category'])
            ->where(function ($query) use ($institute_id) {
                $query->where('creater_id', $institute_id)
                      ->where('creater_type', 'App\Models\Institute');
            })
            ->orWhere('institute_id', $institute_id)
            ->latest()
            ->get();
    }
    public function getEmployeeJobPosts($employee_id): Collection
    {
        return JobPost::with(['institute', 'category'])
            ->orWhere('employee_id', $employee_id)
            ->latest()
            ->get();
    }

    public function statusChange(JobPost $jobPost, int $status): bool
    {
        $jobPost->status = $status;
        return $jobPost->update();
    }

    public function getDetails(JobPost $jobPost): JobPost
    {
        $jobPost->load(['institute', 'category']);
        return $jobPost;
    }

    /**
     * Create new Job Post
     */
    public function createJobPost(array $data): JobPost
    {
        return JobPost::create($data);
    }

    /**
     * Update existing Job Post
     */
    public function updateJobPost(JobPost $jobPost, array $data): bool
    {
        return $jobPost->update($data);
    }

    /**
     * Delete Job Post
     */
    public function deleteJobPost(JobPost $jobPost): bool
    {
        return $jobPost->delete();
    }

    /**
     * Get recent job posts
     */
    public function getRecentJobs(): Collection
    {
        return JobPost::with(['institute', 'category'])
            ->where('status', JobPost::STATUS_ACCEPTED)
            ->where('deadline', '>=', now())
            ->latest()
            ->take(5)
            ->get();
    }

    /**
     * Get employee's applied jobs
     */
    public function getEmployeeAppliedJobs($employee_id): Collection
    {
        return JobPost::with(['institute', 'category'])
            ->whereHas('applications', function ($query) use ($employee_id) {
                $query->where('employee_id', $employee_id);
            })
            ->latest()
            ->get();
    }

    /**
     * Get active job posts
     */
    public function getActiveJobs(): Collection
    {
        return JobPost::with(['institute', 'category'])
            ->where('status', JobPost::STATUS_ACCEPTED)
            ->where('deadline', '>=', now())
            ->latest()
            ->get();
    }
}
