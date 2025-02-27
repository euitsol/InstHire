<?php

namespace App\Http\Controllers\Institute\JobPostManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institute\JobPostRequest;
use App\Models\Employee;
use App\Models\Institute;
use App\Models\JobCategory;
use App\Models\JobPost;
use App\Services\EmployeeService;
use App\Services\JobCategoryService;
use App\Services\JobPostService;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    protected $jobPostService;
    protected $employeeService;
    protected $jobCategoryService;

    public function __construct(JobPostService $jobPostService, EmployeeService $employeeService, JobCategoryService $jobCategoryService)
    {
        $this->middleware("auth:institute");
        $this->jobPostService = $jobPostService;
        $this->employeeService = $employeeService;
        $this->jobCategoryService = $jobCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = $this->jobPostService->getInstituteJobPosts(institute()->id);
        return view('institute.job-post-management.job-post.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->jobCategoryService->getJobCategories();
        $employees = $this->employeeService->getAcceptedInstituteEmployees(institute()->id);
        return view('institute.job-post-management.job-post.create', compact('categories', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPostRequest $request)
    {
        try {


            $data['institute_id'] = $request->visibility == JobPost::VISIBLE_INSTITUTE ? institute()->id : null;
            $data['creater_id'] = institute()->id;
            $data['creater_type'] = get_class(institute());

            $this->jobPostService->createJobPost(array_merge($request->validated(), $data));

            return redirect()
                ->route('institute.job-post.index')
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
        return view('institute.job-post-management.job-post.show', compact('jobPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $jobPost)
    {
        $categories = $this->jobCategoryService->getJobCategories();
        $employees = $this->employeeService->getAcceptedInstituteEmployees(institute()->id);
        return view('institute.job-post-management.job-post.edit', compact('jobPost', 'categories', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPostRequest $request, JobPost $jobPost)
    {
        try {
            $data = $request->validated();

            $this->jobPostService->updateJobPost($jobPost, $data);

            return redirect()
                ->route('institute.job-post.index')
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
        try {
            $this->jobPostService->deleteJobPost($jobPost);

            return redirect()
                ->route('institute.job-post.index')
                ->with('success', 'Job Post deleted successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong!');
        }
    }

    /**
     * Change the status of the specified resource.
     */
    public function statusChange(Request $request, JobPost $jobPost)
    {
        try {
            $status = $request->status;
            $this->jobPostService->statusChange($jobPost, $status);

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }
}
