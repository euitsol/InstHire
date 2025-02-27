<?php

namespace App\Http\Controllers\Institute;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstituteRequest;
use App\Models\Institute;
use App\Services\InstituteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\InstituteSubscriptionService;

class InstituteController extends Controller
{
    protected $instituteService;
    protected $instituteSubscriptionService;

    public function __construct(InstituteService $instituteService, InstituteSubscriptionService $instituteSubscriptionService)
    {
        $this->middleware("auth:institute");
        $this->instituteService = $instituteService;
        $this->instituteSubscriptionService = $instituteSubscriptionService;
    }

    public function dashboard()
    {
        $institute = institute();
        $currentSubscription = $this->instituteSubscriptionService->getInstCurrentSubs($institute->id);
        return view('institute.dashboard', compact('currentSubscription'));
    }

    public function profile()
    {
        $institute = institute();
        return view('institute.profile.index', compact('institute'));
    }

    public function updateProfile(InstituteRequest $request)
    {
        $institute = institute();
        $this->instituteService->update($institute, $request->validated());
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
