<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function dashboard()
    {
        $student = Auth::guard('student')->user();
        return view('student.dashboard', compact('student'));
    }

    public function profile()
    {
        $student = Auth::guard('student')->user();
        return view('student.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $student = Student::findOrFail(student()->id);

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $student->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            $student->password = Hash::make($request->password);
        }

        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->save();

        return back()->with('success', 'Profile updated successfully.');
    }

}
