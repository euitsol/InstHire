<?php

namespace App\Http\Controllers\Institute\JobFair;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobFairRequest;
use App\Models\JobFair;
use App\Models\JobFairStallOption;
use App\Services\JobFairService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobFairController extends Controller
{
    protected $jobFairService;

    public function __construct(JobFairService $jobFairService)
    {
        $this->jobFairService = $jobFairService;
    }

    public function index()
    {
        $jobFairs = $this->jobFairService->getJobFairs(institute()->id);
        return view('institute.job_fair.index', compact('jobFairs'));
    }

    public function create()
    {
        return view('institute.job_fair.create');
    }

    public function store(JobFairRequest $request)
    {
        try {
            $data = $request->validated();
            $data['institute_id'] = institute()->id;
            $data['slug'] = Str::slug($data['title']);
            $data['status'] = JobFair::SCHEDULED;
            $data['creater_id'] = institute()->id;
            $data['creater_type'] = 'App\Models\Institute';

            $jobFair = $this->jobFairService->createJobFair($data);

            return redirect()->route('institute.jf.index')
                ->with('success', __('Job fair created successfully'));
        } catch (\Exception $e) {
            return back()->with('error', __('Something went wrong'))->withInput();
        }
    }

    public function edit(JobFair $jobFair)
    {
        return view('institute.job_fair.edit', compact('jobFair'));
    }

    public function update(JobFairRequest $request, JobFair $jobFair)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['title']);

            $this->jobFairService->updateJobFair($jobFair, $data);

            return redirect()->route('institute.jf.index')
                ->with('success', __('Job fair updated successfully'));
        } catch (\Exception $e) {
            return back()->with('error', __('Something went wrong'));
        }
    }

    public function destroy(JobFair $jobFair)
    {
        try {
            $this->jobFairService->deleteJobFair($jobFair);
            return response()->json(['message' => __('Job fair deleted successfully')]);
        } catch (\Exception $e) {
            return response()->json(['message' => __('Something went wrong')], 500);
        }
    }

    public function getActiveOptions()
    {
        $options = JobFairStallOption::where('status', true)
            ->where('institute_id', institute()->id)
            ->active()
            ->select('id', 'stall_size', 'maximum_representative', 'description')
            ->get();

        return response()->json($options);
    }
}
