<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:student');
    }

    public function showLinkRequestForm()
    {
        return view('student.auth.passwords.email');
    }

    public function broker()
    {
        return Password::broker('students');
    }
}
