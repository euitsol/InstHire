<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:employee')->except('logout');
    }

    public function login()
    {
        if (Auth::guard('employee')->check()) {
            return redirect()->route('employee.dashboard');
        }
        return view('employee.auth.login');
    }

    public function loginCheck(LoginRequest $request)
    {
        if (Auth::guard('employee')->attempt($request->validated())) {
            $request->session()->regenerate();
            session()->flash('success', 'Welcome back');
            return redirect()->intended(route('employee.dashboard'));
        }
        session()->flash('error', 'The provided credentials do not match our records.');
        return back()->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('employee.login');
    }
}
