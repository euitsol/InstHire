<?php

namespace App\Http\Controllers\Student\Job;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index()
    {
        $applications = JobApplication::with('jobPost')
            ->where('student_id', Auth::guard('student')->id())
            ->latest()
            ->paginate(10);
            
        return view('student.job.index', compact('applications'));
    }
    
    public function show($id)
    {
        $application = JobApplication::with('jobPost')
            ->where('student_id', Auth::guard('student')->id())
            ->findOrFail($id);
            
        return view('student.job.show', compact('application'));
    }
}
