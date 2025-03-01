<?php

namespace App\Http\Controllers\Student\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobFair;
use App\Models\JobFairRegistration;
use Illuminate\Support\Facades\Auth;

class JobFairController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index()
    {
        // Get the student's institute ID
        $instituteId = Auth::guard('student')->user()->institute_id;
        
        // Get all job fairs for the student's institute
        $jobFairs = JobFair::where('institute_id', $instituteId)
                          ->orderBy('start_date', 'desc')
                          ->paginate(10);
        
        return view('student.job-fair.index', compact('jobFairs'));
    }
    
    public function show($slug)
    {
        // Get the student's institute ID
        $instituteId = Auth::guard('student')->user()->institute_id;
        
        // Get the job fair details
        $jobFair = JobFair::where('slug', $slug)
                         ->where('institute_id', $instituteId)
                         ->firstOrFail();
        
        // Get registered companies for this job fair
        $registeredCompanies = JobFairRegistration::where('job_fair_id', $jobFair->id)->get();
        
        return view('student.job-fair.show', compact('jobFair', 'registeredCompanies'));
    }
}
