<?php

namespace App\Http\Controllers\Institute;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstituteRequest;
use App\Models\Institute;
use App\Services\InstituteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstituteController extends Controller
{
    protected $instituteService;

    public function __construct(InstituteService $instituteService)
    {
        $this->instituteService = $instituteService;
    }

    public function dashboard()
    {
        return view('institute.dashboard');
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
