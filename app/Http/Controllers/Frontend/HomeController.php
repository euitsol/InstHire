<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\JobCategory;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured job posts (latest 6 visible and accepted jobs)
        $featuredJobs = JobPost::where('visibility', JobPost::VISIBLE_PUBLIC)
            ->where('status', JobPost::STATUS_ACCEPTED)
            ->latest()
            ->take(6)
            ->get();
            
        // Get all active job categories for the search dropdown
        $categories = JobCategory::active()->get();
        
        return view('frontend.pages.home', compact('featuredJobs', 'categories'));
    }
}
