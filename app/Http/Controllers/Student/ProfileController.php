<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\ProfileRequest;
use App\Models\Student;
use App\Services\StudentProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(StudentProfileService $profileService)
    {
        $this->middleware('auth:student');
        $this->profileService = $profileService;
    }

    public function index()
    {
        $data['student'] = Student::with(['institute', 'department', 'session'])->findOrFail(auth()->guard('student')->id());
        return view('student.profile.index', $data);
    }

    public function update(ProfileRequest $request)
    {
        // try {
            // Get authenticated student
            $student = Student::findOrFail(auth()->guard('student')->id());

            // Update profile using service
            $this->profileService->updateProfile($student, $request->validated());

            // Determine success message based on whether password was updated
            $message = $request->filled('current_password')
                ? 'Profile and password updated successfully!'
                : 'Profile updated successfully!';

            return redirect()->route('student.profile.index')->with('success', $message);
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        // }
    }
}
