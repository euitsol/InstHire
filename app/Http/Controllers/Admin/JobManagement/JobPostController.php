<?php

namespace App\Http\Controllers\Admin\JobManagement;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Services\JobPostService;
use Illuminate\Contracts\View\View;

class JobPostController extends Controller
{
    protected JobPostService $jobPostService;

    public function __construct(JobPostService $jobPostService)
    {
        $this->middleware('auth:admin');
        $this->jobPostService = $jobPostService;
    }

    /**
     * Display a listing of the job posts.
     */
    public function index(): View
    {
        $jobPosts = $this->jobPostService->getJobPosts();
        return view('admin.job-post.index', compact('jobPosts'));
    }

    /**
     * Display the specified job post.
     */
    public function show(JobPost $jobPost): View
    {
        $jobPost->load(['category', 'institute', 'employee', 'creater', 'updater']);
        return view('admin.job-post.show', compact('jobPost'));
    }
}
