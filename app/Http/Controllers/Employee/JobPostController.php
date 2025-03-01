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
        $jobs = $this->jobPostService->getEmployeeJobPosts(employee()->id);
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
        $data = $request->validated();
        $data['employee_id'] = employee()->id;
        $data['type'] = JobPost::TYPE_SELF;
        $data['creater_id'] = employee()->id;
        $data['creater_type'] = get_class(employee());

        $this->jobPostService->createJobPost($data);
        return redirect()->route('employee.job-posts.index')->with('success', 'Job posted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        abort_if($jobPost->employee_id !== employee()->id, 403);
        $jobPost = $this->jobPostService->getDetails($jobPost);
        return view('employee.job-post-management.job-post.show', compact('jobPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $jobPost)
    {
        abort_if($jobPost->employee_id !== employee()->id, 403);
        abort_if($jobPost->status !== JobPost::STATUS_PENDING, 403);

        $categories = $this->jobCategoryService->getJobCategories();
        return view('employee.job-post-management.job-post.edit', compact('jobPost', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPostRequest $request, JobPost $jobPost)
    {
        abort_if($jobPost->employee_id !== employee()->id, 403);
        abort_if($jobPost->status !== JobPost::STATUS_PENDING, 403);

        $this->jobPostService->updateJobPost($jobPost, $request->validated());
        return redirect()->route('employee.job-posts.index')->with('success', 'Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost)
    {
        abort_if($jobPost->employee_id !== employee()->id, 403);
        abort_if($jobPost->status !== JobPost::STATUS_PENDING, 403);

        $jobPost->delete();
        return redirect()->route('employee.job-posts.index')->with('success', 'Job deleted successfully');
    }

    /**
     * Get job posts data for DataTables.
     */
    public function getData(Request $request)
    {
        $jobPosts = JobPost::with(['institute', 'category'])
            ->where('employee_id', employee()->id)
            ->where('status', '!=', JobPost::STATUS_CLOSED)
            ->latest();

        return DataTables::of($jobPosts)
            ->addColumn('action', function ($jobPost) {
                return view('employee.job-post-management.job-post.includes.actions', compact('jobPost'));
            })
            ->addColumn('status_badge', function ($jobPost) {
                return view('employee.job-post-management.job-post.includes.status', compact('jobPost'));
            })
            ->editColumn('deadline', function ($jobPost) {
                return $jobPost->deadline->format('d M, Y');
            })
            ->editColumn('created_at', function ($jobPost) {
                return $jobPost->created_at->format('d M, Y');
            })
            ->rawColumns(['action', 'status_badge'])
            ->make(true);
    }

    /**
     * Get archived job posts data for DataTables.
     */
    public function getArchivedData(Request $request)
    {
        $jobPosts = JobPost::with(['institute', 'category'])
            ->where('employee_id', employee()->id)
            ->where('status', JobPost::STATUS_CLOSED)
            ->latest();

        return DataTables::of($jobPosts)
            ->addColumn('action', function ($jobPost) {
                return view('employee.job-post-management.job-post.includes.archive-actions', compact('jobPost'));
            })
            ->addColumn('status_badge', function ($jobPost) {
                return view('employee.job-post-management.job-post.includes.status', compact('jobPost'));
            })
            ->editColumn('deadline', function ($jobPost) {
                return $jobPost->deadline->format('d M, Y');
            })
            ->editColumn('created_at', function ($jobPost) {
                return $jobPost->created_at->format('d M, Y');
            })
            ->rawColumns(['action', 'status_badge'])
            ->make(true);
    }

    /**
     * Show archived jobs.
     */
    public function archive()
    {
        return view('employee.job-post-management.job-post.archive');
    }

    /**
     * Change job post status.
     */
    public function status(JobPost $jobPost, $status)
    {
        abort_if($jobPost->employee_id !== employee()->id, 403);

        if (!in_array($status, [JobPost::STATUS_CLOSED])) {
            abort(404);
        }

        $this->jobPostService->statusChange($jobPost, $status);
        return redirect()->back()->with('success', 'Job status updated successfully');
    }

    /**
     * Show job post profile.
     */
    public function profile(JobPost $jobPost)
    {
        abort_if($jobPost->employee_id !== employee()->id, 403);
        $jobPost = $this->jobPostService->getDetails($jobPost);
        return view('employee.job-post-management.job-post.profile', compact('jobPost'));
    }
}
