<?php

namespace App\Http\Controllers\Admin\JobManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobCategory\StoreRequest;
use App\Http\Requests\JobCategory\UpdateRequest;
use App\Models\JobCategory;
use App\Services\JobCategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class JobCategoryController extends Controller
{
    protected JobCategoryService $jobCategoryService;

    public function __construct(JobCategoryService $jobCategoryService)
    {
        $this->middleware('auth:admin');
        $this->jobCategoryService = $jobCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobCategories = $this->jobCategoryService->getJobCategories();
        return view('admin.job-category.index', compact('jobCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.job-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $this->jobCategoryService->createJobCategory($request->validated());
            session()->flash('success', 'Job category created successfully');
            return redirect()->route('jm.job-category.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobCategory $jobCategory): JsonResponse
    {
        return response()->json($this->jobCategoryService->getDetails($jobCategory));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobCategory $jobCategory): View
    {
        return view('admin.job-category.edit', compact('jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, JobCategory $jobCategory): RedirectResponse
    {
        try {
            $this->jobCategoryService->updateJobCategory($jobCategory, $request->validated());
            session()->flash('success', 'Job category updated successfully');
            return redirect()->route('jm.job-category.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCategory $jobCategory): RedirectResponse
    {
        try {
            $this->jobCategoryService->deleteJobCategory($jobCategory);
            session()->flash('success', 'Job category deleted successfully');
            return redirect()->route('jm.job-category.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong');
            return redirect()->route('jm.job-category.index');
        }
    }

    /**
     * Change the status of the specified resource.
     */
    public function status(JobCategory $jobCategory): RedirectResponse
    {
        try {
            $this->jobCategoryService->statusChange($jobCategory);
            session()->flash('success', 'Status updated successfully');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong');
            return back();
        }
    }
}
