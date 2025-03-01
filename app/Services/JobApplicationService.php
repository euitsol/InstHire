<?php

namespace App\Services;

use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;

class JobApplicationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createApplication(array $data, JobPost $jobPost)
    {
        $applicationData = [
            'job_post_id' => $jobPost->id,
            'status' => JobApplication::STATUS_APPLIED,
            'applicant_name' => $data['applicant_name'],
            'applicant_email' => $data['applicant_email'],
            'applicant_phone' => $data['applicant_phone'],
            'degree' => $data['degree'],
            'institute' => $data['institute'],
            'result' => $data['result'],
            'cover_letter' => $data['cover_letter']
        ];

        // If user is logged in as student, associate the application
        if (Auth::guard('student')->check()) {
            $applicationData['student_id'] = Auth::guard('student')->id();

            // If CV is selected
            if (isset($data['cv_id'])) {
                $applicationData['cv_id'] = $data['cv_id'];
            }
        }

        return JobApplication::create($applicationData);
    }

    /**
     * Check if user has already applied to this job
     */
    public function hasAlreadyApplied(JobPost $jobPost)
    {
        if (!Auth::guard('student')->check()) {
            return false;
        }

        return JobApplication::where('job_post_id', $jobPost->id)
            ->where('student_id', Auth::guard('student')->id())
            ->exists();
    }
}
