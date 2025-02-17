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
        if (Auth::guard('institute')->check()) {
            return redirect()->route('institute.dashboard');
        }
        return view('institute.auth.register');
    }

    public function register(InstituteRegistrationRequest $request)
    {
        $institute = $this->instituteService->create($request->validated());

        Auth::guard('institute')->login($institute);
        session()->flash('success', 'Registration successful! Welcome to your dashboard.');
        return redirect()->route('institute.dashboard');

    }
}
