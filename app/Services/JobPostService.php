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
        return JobPost::with(['institute', 'category', 'employee'])->latest()->get();
    }

    public function getInstituteJobPosts($institute_id): Collection
    {
        return JobPost::with(['institute', 'category', 'employee'])
        ->where(function ($query) use ($institute_id) {
            $query->where('creater_id', $institute_id)
                  ->where('creater_type', 'App\Models\Institute');
        })
        ->orWhere('institute_id', $institute_id)
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
        $jobPost->load(['institute', 'category', 'employee']);
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
}
