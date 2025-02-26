<?php

namespace App\Http\Controllers\Institute\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institute\JobFairStallOptionRequest;
use App\Models\JobFairStallOption;
use App\Services\JobFairStallOptionService;
use Illuminate\Http\Request;

class JobFairStallOptionController extends Controller
{
    protected $stallOptionService;

    public function __construct(JobFairStallOptionService $stallOptionService)
    {
        $this->stallOptionService = $stallOptionService;
        $this->middleware('auth:institute');
    }

    public function list()
    {
        $stallOptions = $this->stallOptionService->getInstituteStallOptions(institute()->id);
        return view('institute.setup.stall_option.index', compact('stallOptions'));
    }

    public function create()
    {
        return view('institute.setup.stall_option.create');
    }

    public function store(JobFairStallOptionRequest $request)
    {
        $data = $request->validated();
        $data['institute_id'] = institute()->id;

        try {
            $this->stallOptionService->createStallOption($data);
            return redirect()->route('institute.setup.jfs.list')
                ->with('success', 'Stall option created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create stall option.');
        }
    }

    public function show(JobFairStallOption $stallOption)
    {
        return response()->json($stallOption);
    }

    public function edit(JobFairStallOption $stallOption)
    {
        return view('institute.setup.stall_option.edit', compact('stallOption'));
    }

    public function update(JobFairStallOptionRequest $request, JobFairStallOption $stallOption)
    {
        $data = $request->validated();

        try {
            $this->stallOptionService->updateStallOption($stallOption, $data);
            return redirect()->route('institute.setup.jfs.list')
                ->with('success', 'Stall option updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update stall option.');
        }
    }

    public function toggleStatus(JobFairStallOption $stallOption)
    {
        try {
            $this->stallOptionService->toggleStatus($stallOption);
            session()->flash('success', 'Status updated successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update status');
        }
        return redirect()->back();
    }

    public function delete(JobFairStallOption $stallOption)
    {
        try {
            $this->stallOptionService->delete($stallOption);
            session()->flash('success', 'Stall option deleted successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete stall option');
        }
        return redirect()->back();
    }
}
