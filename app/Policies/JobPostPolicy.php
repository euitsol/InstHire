<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\JobPost;

class JobPostPolicy
{
    public function view(Employee $employee, JobPost $jobPost): bool
    {
        return $employee->id === $jobPost->employee_id;
    }

    public function update(Employee $employee, JobPost $jobPost): bool
    {
        return $employee->id === $jobPost->employee_id && $jobPost->status === JobPost::STATUS_PENDING;
    }

    public function delete(Employee $employee, JobPost $jobPost): bool
    {
        return $employee->id === $jobPost->employee_id && $jobPost->status === JobPost::STATUS_PENDING;
    }

    public function close(Employee $employee, JobPost $jobPost): bool
    {
        return $employee->id === $jobPost->employee_id && $jobPost->status === JobPost::STATUS_ACCEPTED;
    }
}
