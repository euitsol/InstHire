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
            if(student()){
                $type = 'App\\Models\\Student';
                $id = student()->id;
                $path = 'cvs/student/' . $id;
            }

            // Handle file upload
            $file = $request->file('cv_file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            // Generate a unique filename
            $filename = Str::slug($request->title) . '-' . time() . '.' . $extension;

            $filePath = $file->storeAs($path, $filename, 'public');

            // Create CV record
            Cvs::create([
                'title' => $request->title,
                'file_path' => $filePath,
                'creater_id' => $id,
                'creater_type' => $type,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('CV Upload Error: ' . $e->getMessage());
            return false;
        }
    }
}
