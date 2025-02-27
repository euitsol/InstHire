<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student');
    }

    public function register()
    {
        $data['institutes'] = Institute::active()->get();
        return view('student.auth.register', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'phone' => 'required|string|max:20|unique:students',
            'institute_id' => 'required|exists:institutes,id',
            'department_id' => 'required|exists:departments,id',
            'session_id' => 'required|exists:institute_sessions,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institute_id' => $request->institute_id,
            'department_id' => $request->department_id,
            'session_id' => $request->session_id,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        Auth::guard('student')->login($student);

        return redirect()->route('student.dashboard');
    }
    public function departments(Institute $institute)
    {
        $institute->load('activeDepartments');
        $departments = $institute->activeDepartments->select('name', 'id');
        return response()->json($departments);
    }

    public function sessions(Institute $institute)
    {
        $institute->load('activeSessions');
        $sessions = $institute->activeSessions->select('name', 'id');
        return response()->json($sessions);
    }
}
