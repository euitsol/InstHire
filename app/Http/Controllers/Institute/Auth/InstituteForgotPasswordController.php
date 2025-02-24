<?php

namespace App\Http\Controllers\Institute\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class InstituteForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:institute');
    }

    public function showLinkRequestForm()
    {
        if (Auth::guard('institute')->check()) {
            return redirect()->route('institute.dashboard');
        }
        return view('institute.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:institutes,email',
        ]);

        $status = Password::broker('institutes')->sendResetLink(
            $request->only('email')
        );
        session()->flash('success', __($status));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    protected function broker()
    {
        return Password::broker('institutes');
    }
}
