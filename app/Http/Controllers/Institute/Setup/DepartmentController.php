<?php

namespace App\Http\Controllers\Institute\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institute\DepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $departments = $this->departmentService->getInstituteDepartments(institute()->id);
        return view('institute.setup.department.index', compact('departments'));
    }

    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        $data['institute_id'] = institute()->id;

        try {
            $this->departmentService->createDepartment($data);
            return response()->json(['message' => 'Department created successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create department'], 500);
        }
    }

    public function show(Department $department)
    {
        return response()->json($department);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $data = $request->validated();

        try {
            $this->departmentService->updateDepartment($department, $data);
            return response()->json(['message' => 'Department updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update department'], 500);
        }
    }

    public function toggleStatus(Department $department)
    {
        try {
            $this->departmentService->toggleStatus($department);
            session()->flash('success', 'Status updated successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update status');
        }
        return redirect()->back();
    }

    public function delete(Department $department)
    {
        try {
            $this->departmentService->delete($department);
            session()->flash('success', 'Department deleted successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete department');
        }
        return redirect()->back();
    }
}
