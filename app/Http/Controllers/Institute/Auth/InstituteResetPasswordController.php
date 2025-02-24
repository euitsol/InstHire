<?php

namespace App\Http\Controllers\Institute\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class InstituteResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        if (Auth::guard('institute')->check()) {
            return redirect()->route('institute.dashboard');
        }
        return view('institute.auth.passwords.reset')->with(
            ['token' => $request->token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('institutes')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        session()->flash($status == Password::PASSWORD_RESET ? 'success' : 'error', __($status));

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('institute.login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
