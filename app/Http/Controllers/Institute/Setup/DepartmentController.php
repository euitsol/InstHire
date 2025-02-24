<?php

namespace App\Http\Controllers\Institute\Setup;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['institute_id'] = institute()->id;

        try {
            $this->departmentService->createDepartment($data);
            return response()->json(['message' => 'Department created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create department'], 500);
        }
    }

    public function show(Department $department)
    {
        return response()->json($department);
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        try {
            $this->departmentService->updateDepartment($department, $request->all());
            return response()->json(['message' => 'Department updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update department'], 500);
        }
    }

    public function toggleStatus(Department $department)
    {
        try {
            $this->departmentService->toggleStatus($department);
            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update status'], 500);
        }
    }
}
