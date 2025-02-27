<?php

namespace App\Services;

use App\Models\JobFair;
use App\Models\JobFairStall;
use Illuminate\Database\Eloquent\Collection;

class JobFairService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getJobFairs($instituteId):Collection
    {
        return JobFair::where('institute_id', $instituteId)
            ->latest()->get();
    }

    public function createJobFair(array $data)
    {
        $jobFair = JobFair::create([
            'institute_id' => $data['institute_id'],
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'maximum_companies' => $data['maximum_companies'],
            'status' => $data['status'],
            'creater_id' => $data['creater_id'],
            'creater_type' => $data['creater_type']

        ]);

        // Create stalls for each selected option
        foreach ($data['stall_options'] as $optionId) {
            JobFairStall::create([
                'job_fair_id' => $jobFair->id,
                'job_fair_stall_option_id' => $optionId,
                'creater_id' => $data['creater_id'],
                'creater_type' => $data['creater_type']
            ]);
        }

        return $jobFair;
    }

    public function updateJobFair(JobFair $jobFair, array $data)
    {
        $jobFair->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'maximum_companies' => $data['maximum_companies'],
        ]);

        // Update stalls
        $jobFair->stalls()->delete();
        foreach ($data['stall_options'] as $optionId) {
            JobFairStall::create([
                'job_fair_id' => $jobFair->id,
                'job_fair_stall_option_id' => $optionId,
            ]);
        }

        return $jobFair;
    }

    public function deleteJobFair(JobFair $jobFair)
    {
        return $jobFair->delete();
    }
}
