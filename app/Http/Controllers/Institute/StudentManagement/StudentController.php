<?php

namespace App\Http\Controllers\Institute\StudentManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institute\StudentRequest;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Student;
use App\Services\DepartmentService;
use App\Services\SessionService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected StudentService $studentService;
    protected SessionService $sessionService;
    protected DepartmentService $departmentService;

    public function __construct(StudentService $studentService, SessionService $sessionService, DepartmentService $departmentService)
    {
        $this->studentService = $studentService;
        $this->sessionService = $sessionService;
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = $this->studentService->getInstituteStudents(institute()->id);
        return view('institute.student-management.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['sessions'] = $this->sessionService->getInstituteSessions(institute()->id);
        $data['departments'] = $this->departmentService->getInstituteDepartments(institute()->id);
        return view('institute.student-management.student.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $audits['creater_type'] = Institute::class;
        $audits['creater_id'] = institute()->id;
        $this->studentService->createStudent(array_merge($request->validated(), $audits));
        session()->flash('success', 'Student created successfully');
        return redirect()->route('institute.student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student = $this->studentService->getDetails($student);
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $data['student'] = $this->studentService->getDetails($student);
        $data['sessions'] = $this->sessionService->getInstituteSessions(institute()->id);
        $data['departments'] = $this->departmentService->getInstituteDepartments(institute()->id);
        return view('institute.student-management.student.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->updater()->associate(institute());
        $this->studentService->updateStudent($student, $request->validated());
        session()->flash('success', 'Student updated successfully');
        return redirect()->route('institute.student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->deleter()->associate(institute());
        $this->studentService->deleteStudent($student);
        session()->flash('success', 'Student deleted successfully');
        return redirect()->route('institute.student.index');
    }

    /**
     * Update employee status.
     */
    public function status(Student $student, int $status)
    {
        $student->updater()->associate(institute());
        $this->studentService->statusChange($student, $status);
        session()->flash('success', 'Student status updated successfully');
        return redirect()->back();
    }

    /**
     * Display the authenticated employee's profile.
     */
    public function profile(Student $student)
    {
        $student = $this->studentService->getDetails($student);
        return view('institute.student-management.student.profile', compact('student'));
    }

    /**
     * Update the authenticated employee's profile.
     */
    public function updateProfile(StudentRequest $request, Student $student)
    {
        $student->updater()->associate(institute());
        $this->studentService->updateStudent($student, $request->validated());
        session()->flash('success', 'Profile updated successfully');
        return redirect()->route('institute.student.profile', $student->id);
    }
}
