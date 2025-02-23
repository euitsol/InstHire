<?php

namespace App\Http\Controllers\Institute\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstituteRegistrationRequest;
use App\Services\InstituteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\InstituteSubscriptionService;

class RegisterController extends Controller
{
    protected InstituteService $instituteService;
    protected InstituteSubscriptionService $instituteSubscriptionService;

    public function __construct(InstituteService $instituteService, InstituteSubscriptionService $instituteSubscriptionService)
    {
        $this->instituteService = $instituteService;
        $this->instituteSubscriptionService = $instituteSubscriptionService;
    }

    public function showRegistrationForm()
    {
        if (Auth::guard('institute')->check()) {
            return redirect()->route('institute.dashboard');
        }
        return view('institute.auth.register');
    }

    public function register(InstituteRegistrationRequest $request)
    {
        $data['slug'] = Str::slug($request->input('name'));
        $institute = $this->instituteService->create(array_merge($request->validated(), $data));
        $data['institute_id'] = $institute->id;
        $data['subscription_id'] = 1;
        $this->instituteSubscriptionService->create($data);

        Auth::guard('institute')->login($institute);
        session()->flash('success', 'Registration successful! Welcome to your dashboard.');
        return redirect()->route('institute.dashboard');
    }
}
