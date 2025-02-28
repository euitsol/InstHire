<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CVRequest;
use App\Models\Cvs;
use App\Models\Student;
use App\Services\UploadCVService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller
{
    protected $uploadCVService;

    public function __construct(UploadCVService $uploadCVService)
    {
        $this->middleware('auth:student');
        $this->uploadCVService = $uploadCVService;
    }

    public function index()
    {
        $student = auth()->guard('student')->user();
        $data['student'] = $student;
        $data['cvs'] = Cvs::where('student_id', $student->id)
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);

        return view('student.cv.index', $data);
    }

    public function update(CVRequest $request)
    {
        try {
            $result = $this->uploadCVService->upload($request);

            if ($result) {
                return redirect()->route('student.cv.index')->with('success', 'CV uploaded successfully!');
            }

            return redirect()->back()->with('error', 'Failed to upload CV. Please try again.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $cv = Cvs::where('student_id', auth()->guard('student')->id())
                ->findOrFail($id);

            // Delete the file from storage
            if ($cv->file_path && Storage::exists($cv->file_path)) {
                Storage::delete($cv->file_path);
            }

            $cv->delete();

            return redirect()->route('student.cv.index')->with('success', 'CV deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
