<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Show the employee profile page.
     */
    public function index()
    {
        return view('employee.profile.index');
    }

    /**
     * Show the security settings page.
     */
    public function security()
    {
        return view('employee.profile.security');
    }

    /**
     * Update the employee's profile information.
     */
    public function update(EmployeeRequest $request)
    {
        $employee = auth()->guard('employee')->user();
        $this->employeeService->updateEmployee($employee, $request->validated());

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the employee's profile photo.
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $employee = auth()->guard('employee')->user();
        $this->employeeService->updateEmployee($employee, $request->only('image'));

        return back()->with('success', 'Profile photo updated successfully.');
    }

    /**
     * Update the employee's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password:employee'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $employee = auth()->guard('employee')->user();
        $this->employeeService->updateEmployee($employee, [
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
