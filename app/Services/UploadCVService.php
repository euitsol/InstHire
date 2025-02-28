<?php

namespace App\Services;

use App\Http\Requests\Student\CVRequest;
use App\Models\Cvs;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadCVService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        // Constructor is now empty
    }

    /**
     * Upload a CV file and save the record
     *
     * @param CVRequest $request
     * @return bool
     */
    public function upload(CVRequest $request): bool
    {
        try {
            $student = auth()->guard('student')->user();

            // Handle file upload
            $file = $request->file('cv_file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            // Generate a unique filename
            $filename = Str::slug($request->title) . '-' . time() . '.' . $extension;

            // Store the file
            $path = 'cvs/' . $student->id;
            $filePath = $file->storeAs($path, $filename, 'public');

            // Create CV record
            Cvs::create([
                'student_id' => $student->id,
                'title' => $request->title,
                'file_path' => $filePath,
                'creater_id' => $student->id,
                'creater_type' => 'App\\Models\\Student',
            ]);

            return true;
        } catch (\Exception $e) {
            // Log the error
            Log::error('CV Upload Error: ' . $e->getMessage());
            return false;
        }
    }
}
