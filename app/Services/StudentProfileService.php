<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentProfileService
{
    public function __construct()
    {
        //
    }

    public function updateProfile(Student $student, array $data): Student
    {
        // Update basic profile information

        if (isset($data['name'])) {
            $student->name = $data['name'];
        }
        if(isset($data['email'])) {
            $student->email = $data['email'];
        }
        if(isset($data['phone'])) {
            $student->phone = $data['phone'];
        }
        if(isset($data['gender'])) {
            $student->gender = $data['gender'];
        }

        // Update academic information if provided
        if (isset($data['roll'])) {
            $student->roll = $data['roll'];
        }

        if (isset($data['registration'])) {
            $student->registration = $data['registration'];
        }

        // Handle password update if provided
        if (isset($data['password'])) {
            $student->password = Hash::make($data['password']);
        }

        // Handle profile image upload if provided
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $student->image = $this->uploadProfileImage($student, $data['image']);
        }

        $student->save();

        return $student;
    }

    protected function uploadProfileImage(Student $student, UploadedFile $image): string
    {
        // Define storage path
        $directory = 'student/' . $student->id . '/profile';

        // Delete old image if exists
        if ($student->image) {
            $oldImagePath = str_replace(asset('storage/'), '', $student->image);
            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }

        // Generate unique filename
        $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();

        // Store the image
        $path = $image->storeAs($directory, $filename, 'public');

        // Return full URL
        return asset('storage/' . $path);
    }
}
