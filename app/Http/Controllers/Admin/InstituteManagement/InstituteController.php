<?php

namespace App\Http\Controllers\Admin\InstituteManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstituteRequest;
use App\Models\Admin;
use App\Models\Institute;
use App\Services\InstituteService;
use Illuminate\Support\Str;

class InstituteController extends Controller
{
    protected InstituteService $instituteService;

    public function __construct(InstituteService $instituteService)
    {
        $this->instituteService = $instituteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institutes = $this->instituteService->getInstitutes();
        return view('admin.institute-management.institute.index', compact('institutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.institute-management.institute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstituteRequest $request)
    {
        $audits['creater_type'] = Admin::class;
        $audits['creater_id'] = auth()->guard('admin')->id();
        $audits['slug'] = Str::slug($request->input('name'));
        $this->instituteService->create(array_merge($request->validated(), $audits));
        return redirect()->route('im.institute.index')->with('success', 'Institute created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Institute $institute)
    {
        $institute->load(['subscriptions']);
        $institute = $this->instituteService->getDetails($institute);
        return response()->json($institute);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institute $institute)
    {
        $institute = $this->instituteService->getDetails($institute);
        return view('admin.institute-management.institute.edit', compact('institute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstituteRequest $request, Institute $institute)
    {
        $audits['updater_type'] = Admin::class;
        $audits['updater_id'] = auth()->guard('admin')->id();
        $audits['slug'] = Str::slug($request->input('name'));
        $this->instituteService->update($institute, array_merge($request->validated(), $audits));
        return redirect()->route('im.institute.index')->with('success', 'Institute updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institute $institute)
    {
        $audits['deleter_type'] = Admin::class;
        $audits['deleter_id'] = auth()->guard('admin')->id();
        $this->instituteService->delete($institute);
        return redirect()->route('im.institute.index')->with('success', 'Institute deleted successfully');
    }

    /**
     * Update employee status.
     */
    public function status(Institute $institute)
    {
        $institute->updater()->associate(auth()->guard('admin')->user());
        $this->instituteService->statusChange($institute);
        return redirect()->back()->with('success', 'Institute status updated successfully');
    }

    /**
     * Display the authenticated employee's profile.
     */
    public function profile(Institute $institute)
    {
        $institute = $this->instituteService->getDetails($institute);
        return view('admin.institute-management.institute.profile', compact('institute'));
    }

    /**
     * Update the authenticated employee's profile.
     */
    public function updateProfile(InstituteRequest $request, Institute $institute)
    {
        $data['updater_type'] = Admin::class;
        $data['updater_id'] = auth()->guard('admin')->id();
        $this->instituteService->update($institute, array_merge($request->validated(), $data));
        return redirect()->route('im.institute.profile', $institute->id)->with('success', 'Profile updated successfully');
    }
}
