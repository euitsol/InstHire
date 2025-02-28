<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\JobCategory;
use App\Models\JobApplication;
use App\Services\JobApplicationService;
use App\Services\UploadCVService;
use App\Http\Requests\JobApplicationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    protected JobApplicationService $jobApplicationService;
    protected UploadCVService $uploadCVService;

    public function __construct(JobApplicationService $jobApplicationService, UploadCVService $uploadCVService)
    {
        $this->jobApplicationService = $jobApplicationService;
        $this->uploadCVService = $uploadCVService;
    }

    public function index(Request $request)
    {
        $query = JobPost::query()
            ->where('visibility', JobPost::VISIBLE_PUBLIC)
            ->where('status', JobPost::STATUS_ACCEPTED);

        // Filter by search term
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->input('category') != '') {
            $query->where('category_id', $request->input('category'));
        }

        // Filter by job type
        if ($request->has('job_type') && $request->input('job_type') != '') {
            $query->where('job_type', $request->input('job_type'));
        }

        // Filter by location
        if ($request->has('location') && $request->input('location') != '') {
            $query->where('job_location', 'like', "%{$request->input('location')}%");
        }

        $jobs = $query->latest()->paginate(12);
        $categories = JobCategory::active()->get();
        $jobTypes = JobPost::getTypeLabels();

        return view('frontend.pages.jobs', compact('jobs', 'categories', 'jobTypes'));
    }

    public function show($id)
    {
        $job = JobPost::where('visibility', JobPost::VISIBLE_PUBLIC)
            ->where('status', JobPost::STATUS_ACCEPTED)
            ->findOrFail($id);

        $hasApplied = $this->jobApplicationService->hasAlreadyApplied($job);

        $relatedJobs = JobPost::where('visibility', JobPost::VISIBLE_PUBLIC)->where('status', JobPost::STATUS_ACCEPTED)->where('category_id', $job->category_id)->where('id', '!=', $job->id)->latest()->take(10)->get();

        return view('frontend.pages.job-details', compact('job', 'hasApplied', 'relatedJobs'));
    }

    public function apply(JobApplicationRequest $request, $id)
    {
        $job = JobPost::where('visibility', JobPost::VISIBLE_PUBLIC)
            ->where('status', JobPost::STATUS_ACCEPTED)
            ->findOrFail($id);

        // Check if already applied
        if ($this->jobApplicationService->hasAlreadyApplied($job)) {
            return response()->json([
                'success' => false,
                'message' => 'You have already applied for this job.'
            ], 422);
        }



        try {

            if($request->has('cv_file')){
                $this->uploadCVService->upload($request);
            }

            $application = $this->jobApplicationService->createApplication($request->validated(), $job);

            return response()->json([
                'success' => true,
                'message' => 'Your application has been submitted successfully.',
                'data' => $application
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting your application. Please try again.'
            ], 500);
        }
    }
}
