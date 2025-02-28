<?php

namespace App\Services;

use App\Http\Requests\Student\CVRequest;
use App\Models\Cvs;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadCVService
{

    public function __construct()
    {

    }

    public function upload($request)
    {
        try {
            $type = null;
            $id = null;
            $path = null;
            $title = null;
            if(student()){
                $type = 'App\\Models\\Student';
                $id = student()->id;
                $path = 'cvs/student/' . $id;
            }else{
                $path = 'cvs/anonymous';
            }

            // Handle file upload
            $file = $request->file('cv_file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            // Generate a unique filename
            if($request->title){
                $title = $request->title;
                $filename = Str::slug($title) . '-' . time() . '.' . $extension;
            }else{
                $filename = time().Str::random(10) . '.' . $extension;
                $title = $originalName;
            }

            $filePath = $file->storeAs($path, $filename, 'public');

            // Create CV record
            $cv = Cvs::create([
                'title' => $title,
                'file_path' => $filePath,
                'creater_id' => $id,
                'creater_type' => $type,
            ]);

            return $cv;
        } catch (\Exception $e) {
            Log::error('CV Upload Error: ' . $e->getMessage());
            return false;
        }
    }
}
