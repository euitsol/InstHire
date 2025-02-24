<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Institute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class EmployeeService
{
    /**
     * Get list of employees
     */
    public function getEmployees(): Collection
    {
        return Employee::with(['verifier', 'verified_by', 'creater'])->latest()->get();
    }
    public function getInstituteEmployees($institute_id): Collection
    {
        return Employee::with(['verifier', 'verified_by', 'creater'])->where('verifier_id', $institute_id)->where('verifier_type', 'App\Models\Institute')->latest()->get();
    }

    public function statusChange(Employee $employee, int $status): bool
    {
        $employee->status = $status;
        return $employee->update();
    }

    public function getDetails(Employee $employee): Employee
    {
        $employee->load(['verifier', 'verified_by', 'creater', 'updater']);
        return $employee;
    }

    /**
     * Create new employee
     */
    public function createEmployee(array $data): Employee
    {
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }
        $data['verifier_type'] = !empty($data['verifier_id']) ? Institute::class : null;
        $data['verifier_id'] = $data['verifier_id'] ?? null;

        return Employee::create($data);
    }

    /**
     * Update existing employee
     */
    public function updateEmployee(Employee $employee, array $data): bool
    {
        if (isset($data['image'])) {
            if ($employee->image) {
                $this->deleteImage($employee->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        $data['password'] = !empty($data['password']) ? $data['password'] : $employee->password;
        return $employee->update($data);
    }

    /**
     * Delete employee (soft delete)
     */
    public function deleteEmployee(Employee $employee): ?bool
    {
        return $employee->delete();
    }

    /**
     * Force delete employee
     */
    public function forceDeleteEmployee(Employee $employee): ?bool
    {
        if ($employee->image) {
            $this->deleteImage($employee->image);
        }
        return $employee->forceDelete();
    }

    /**
     * Upload image to storage
     */
    protected function uploadImage($image): string
    {
        $path = $image->store('employee/profile', 'public');
        return $path;
    }

    /**
     * Delete image from storage
     */
    protected function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
