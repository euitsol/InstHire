<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\JobPostRequest;
use App\Models\JobPost;
use App\Services\JobPostService;
use App\Services\JobCategoryService;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    protected $jobPostService;
    protected $jobCategoryService;

    public function __construct(JobPostService $jobPostService, JobCategoryService $jobCategoryService)
    {
        $this->jobPostService = $jobPostService;
        $this->jobCategoryService = $jobCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $jobs = $this->jobPostService->getActiveJobPosts();
        return view('employee.job-post-management.job-post.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->jobCategoryService->getJobCategories();
        return view('employee.job-post-management.job-post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPostRequest $request)
    {
        try {


            $data['institute_id'] = $request->visibility == JobPost::VISIBLE_INSTITUTE ? employee()->institute_id : null;
            $data['creater_id'] = employee()->id;
            $data['creater_type'] = get_class(employee());
            $data['employee_id'] = employee()->id;

            $this->jobPostService->createJobPost(array_merge($request->validated(), $data));

            return redirect()
                ->route('employee.job-posts.index')
                ->with('success', 'Job Post created successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong! ')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        $jobPost = $this->jobPostService->getDetails($jobPost);
        return view('employee.job-post-management.job-post.show', compact('jobPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $jobPost)
    {
        abort_if($jobPost->employee_id !== employee()->id, 403);
        // abort_if($jobPost->status !== JobPost::STATUS_PENDING, 403);

        $categories = $this->jobCategoryService->getJobCategories();
        return view('employee.job-post-management.job-post.edit', compact('categories' , 'jobPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPostRequest $request, JobPost $jobPost)
    {
        abort_if($jobPost->employee_id !== employee()->id, 403);

        try {
            $data = $request->validated();

            $this->jobPostService->updateJobPost($jobPost, $data);

            return redirect()
                ->route('employee.job-posts.index')
                ->with('success', 'Job Post updated successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong!')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost)
    {
        abort_if($jobPost->employee_id !== employee()->id, 403);

        $jobPost->delete();
        return redirect()->route('employee.job-posts.index')->with('success', 'Job deleted successfully');
    }
}
