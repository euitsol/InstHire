<?php

namespace App\Http\Controllers\Institute\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('institute')->check()) {
            return redirect()->route('institute.dashboard');
        }
        return view('institute.auth.login');
    }

    public function loginCheck(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('institute')->attempt($credentials)) {
            $request->session()->regenerate();
            session()->flash('success', 'Welcome back');
            return redirect()->intended(route('institute.dashboard'));
        }
        session()->flash('error', 'The provided credentials do not match our records.');
        return back()->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('institute')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('institute.login');
    }
}
