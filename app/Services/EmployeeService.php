<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Employee;
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

    public function statusChange(Employee $employee, int $status): bool
    {
        $employee->status = $status;
        return $employee->save();
    }

    public function getDetails(Employee $employee): Employee
    {
        // $employee->modify_image = $employee->image ? asset('storage/' . $employee->image) : strtoupper(substr($employee->name, 0, 1));
        // $employee->creating_time = date('Y-m-d H:i:s', strtotime($employee->created_at));
        // $employee->updating_time = $employee->updated_at ? date('Y-m-d H:i:s', strtotime($employee->updated_at)) : null;
        // $employee->status_labels = Employee::getStatusLabels();
        // $employee->gender_labels = Employee::getGenderLabels();
        $employee->load(['verifier', 'verified_by','creater','updater']);
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
        $data['password'] = bcrypt($data['password']);
        // Set verifier information
        $data['verifier_type'] = !empty($data['verifier_id']) ? Employee::class : null;
        $data['verifier_id'] = $data['verifier_id'] ?? null;
        $data['creater_id'] = admin()->id;
        $data['creater_type'] = get_class(admin());
        return Employee::create($data);
    }

    /**
     * Update existing employee
     */
    public function updateEmployee(Employee $employee, array $data): bool
    {
        if (isset($data['image'])) {
            // Delete old image if exists
            if ($employee->image) {
                $this->deleteImage($employee->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        $data['password'] = !empty($data['password']) ? $data['password']: $employee->password;
        $data['updater_id'] = admin()->id;
        $data['updater_type'] = get_class(admin());
        return $employee->update($data);
    }

    /**
     * Delete employee (soft delete)
     */
    public function deleteEmployee(Employee $employee): ?bool
    {
        $employee->deleter_id = admin()->id;
        $employee->deleter_type = get_class(admin());
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
