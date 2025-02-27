<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobController extends Controller
{

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

        // Get related jobs (same category, excluding current job)
        $relatedJobs = JobPost::where('visibility', JobPost::VISIBLE_PUBLIC)
            ->where('status', JobPost::STATUS_ACCEPTED)
            ->where('category_id', $job->category_id)
            ->where('id', '!=', $job->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.pages.job-details', compact('job', 'relatedJobs'));
    }
}
