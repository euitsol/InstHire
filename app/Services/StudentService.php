<?php

namespace App\Services;

use App\Models\Institute;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class StudentService
{
    /**
     * Get list of Students
     */
    public function getStudents(): Collection
    {
        return Student::with(['institute', 'verified_by', 'creater', 'session', 'department'])->latest()->get();
    }
    public function getInstituteStudents($institute_id): Collection
    {
        return Student::with(['institute', 'verified_by', 'creater', 'session', 'department'])->where('institute_id', $institute_id)->latest()->get();
    }

    public function statusChange(Student $student, int $status): bool
    {
        $student->status = $status;
        return $student->update();
    }

    public function getDetails(Student $student): Student
    {
        $student->load(['institute', 'verified_by', 'creater', 'session', 'department']);
        return $student;
    }

    /**
     * Create new Students
     */
    public function createStudent(array $data): Student
    {
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }
        $data['verified_by_type'] = !empty($data['verifier_id']) ? Institute::class : null;
        $data['verified_by_id'] = $data['verifier_id'] ?? null;

        return Student::create($data);
    }

    /**
     * Update existing Student
     */
    public function updateStudent(Student $student, array $data): bool
    {
        if (isset($data['image'])) {
            if ($student->image) {
                $this->deleteImage($student->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        $data['password'] = !empty($data['password']) ? $data['password'] : $student->password;
        return $student->update($data);
    }

    /**
     * Delete Student (soft delete)
     */
    public function deleteStudent(Student $student): ?bool
    {
        return $student->delete();
    }

    /**
     * Force delete Student
     */
    public function forceDeleteStudent(Student $student): ?bool
    {
        if ($student->image) {
            $this->deleteImage($student->image);
        }
        return $student->forceDelete();
    }

    /**
     * Upload image to storage
     */
    protected function uploadImage($image): string
    {
        $path = $image->store('student/profile', 'public');
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
