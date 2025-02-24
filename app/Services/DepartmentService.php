<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    public function getInstituteDepartments($instituteId)
    {
        return Department::where('institute_id', $instituteId)->get();
    }

    public function createDepartment($data)
    {
        try {
            DB::beginTransaction();
            
            $department = Department::create([
                'name' => $data['name'],
                'status' => $data['status'] ?? true,
                'institute_id' => $data['institute_id']
            ]);

            DB::commit();
            return $department;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateDepartment($department, $data)
    {
        try {
            DB::beginTransaction();

            $department->update([
                'name' => $data['name'],
                'status' => $data['status']
            ]);

            DB::commit();
            return $department;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function toggleStatus($department)
    {
        try {
            DB::beginTransaction();

            $department->update([
                'status' => !$department->status
            ]);

            DB::commit();
            return $department;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
