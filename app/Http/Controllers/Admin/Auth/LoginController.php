<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function loginCheck(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $check = Admin::where('email', $request->email)->first();
        if ($check) {
            if (Auth::guard('admin')->attempt($credentials)) {
                session()->flash('success', 'Welcome');
                return redirect()->route('admin.dashboard');
            }
            session()->flash('error', 'Invalid credentials');
        } else {
            session()->flash('error', 'Record not found');
        }
        return redirect()->route('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}