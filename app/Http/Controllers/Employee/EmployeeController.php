<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $totalJobs = JobPost::active()->count();
        return view('employee.dashboard', compact('totalJobs'));
    }
}
