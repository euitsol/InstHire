<?php

namespace App\Http\Controllers\Institute\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
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
        $this->middleware("auth:institute");
        $this->employeeService = $employeeService;
        $this->instituteService = $instituteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = $this->employeeService->getInstituteEmployees(institute()->id);
        return view('institute.employee-management.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('institute.employee-management.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $audits['creater_type'] = get_class(institute());
        $audits['verifier_type'] = get_class(institute());
        $audits['creater_id'] = institute()->id;
        $audits['verifier_id'] = institute()->id;
        $this->employeeService->createEmployee(array_merge($request->validated(), $audits));
        return redirect()->route('institute.employee.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load(['verifier', 'verified_by']);
        $employee = $this->employeeService->getDetails($employee);
        return view('institute.employee-management.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee = $this->employeeService->getDetails($employee);
        return view('institute.employee-management.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->updater()->associate(institute());
        $this->employeeService->updateEmployee($employee, $request->validated());
        return redirect()->route('institute.employee.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->deleter()->associate(institute());
        $this->employeeService->deleteEmployee($employee);
        return redirect()->route('institute.employee.index')->with('success', 'Employee deleted successfully');
    }

    /**
     * Update employee status.
     */
    public function status(Employee $employee, int $status)
    {
        $employee->updater()->associate(institute());
        $this->employeeService->statusChange($employee, $status);
        return redirect()->back()->with('success', 'Employee status updated successfully');
    }

    /**
     * Display the authenticated employee's profile.
     */
    public function profile(Employee $employee)
    {
        $employee = $this->employeeService->getDetails($employee);
        return view('institute.employee-management.employee.profile', compact('employee'));
    }
}
