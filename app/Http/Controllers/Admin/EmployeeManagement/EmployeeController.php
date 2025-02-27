<?php

namespace App\Http\Controllers\Admin\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Admin;
use App\Models\Employee;
use App\Services\EmployeeService;
use App\Services\InstituteService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;
    protected InstituteService $instituteService;

    public function __construct(EmployeeService $employeeService, InstituteService $instituteService)
    {
        $this->employeeService = $employeeService;
        $this->instituteService = $instituteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = $this->employeeService->getEmployees();
        return view('admin.employee-management.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutes = $this->instituteService->getInstitutes();
        return view('admin.employee-management.employee.create', compact('institutes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $audits['creater_type'] = Admin::class;
        $audits['creater_id'] = admin()->id;
        $audits['verifier_type'] = Admin::class;
        $audits['verifier_id'] = admin()->id;
        $audits['verified_by_type'] = Admin::class;
        $audits['verified_by_id'] = admin()->id;
        $audits['status'] = 1;
        $this->employeeService->createEmployee(array_merge($request->validated(), $audits));
        return redirect()->route('em.employee.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load(['verifier', 'verified_by']);
        $employee = $this->employeeService->getDetails($employee);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee = $this->employeeService->getDetails($employee);
        $institutes = $this->instituteService->getInstitutes();
        return view('admin.employee-management.employee.edit', compact('employee', 'institutes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->updater()->associate(admin());
        $this->employeeService->updateEmployee($employee, $request->validated());
        return redirect()->route('em.employee.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->deleter()->associate(admin());
        $this->employeeService->deleteEmployee($employee);
        return redirect()->route('em.employee.index')->with('success', 'Employee deleted successfully');
    }

    /**
     * Update employee status.
     */
    public function status(Employee $employee, int $status)
    {
        $employee->updater()->associate(admin());
        $this->employeeService->statusChange($employee, $status);
        return redirect()->back()->with('success', 'Employee status updated successfully');
    }

    /**
     * Display the authenticated employee's profile.
     */
    public function profile(Employee $employee)
    {
        $employee = $this->employeeService->getDetails($employee);
        return view('admin.employee-management.employee.profile', compact('employee'));
    }

    /**
     * Update the authenticated employee's profile.
     */
    public function updateProfile(EmployeeRequest $request, Employee $employee)
    {
        $employee->updater()->associate(admin());
        $this->employeeService->updateEmployee($employee, $request->validated());
        return redirect()->route('em.employee.profile', $employee->id)->with('success', 'Profile updated successfully');
    }
}
