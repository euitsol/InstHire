<?php

namespace App\Http\Controllers\Institute\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstituteRegistrationRequest;
use App\Services\InstituteService;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    protected $instituteService;

    public function __construct(InstituteService $instituteService)
    {
        $this->instituteService = $instituteService;
    }

    public function showRegistrationForm()
    {
        return view('institute.auth.register');
    }

    public function register(InstituteRegistrationRequest $request)
    {
        $institute = $this->instituteService->store($request->validated());
        
        Auth::guard('institute')->login($institute);
        
        return redirect()->route('institute.dashboard')
            ->with('success', 'Registration successful! Welcome to your dashboard.');
    }
}
