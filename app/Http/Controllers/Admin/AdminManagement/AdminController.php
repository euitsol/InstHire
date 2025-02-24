<?php

namespace App\Http\Controllers\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->middleware('auth:admin');
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $admins = $this->adminService->getAdmins();
        return view('admin.admin-management.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.admin-management.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request): RedirectResponse
    {
        try {
            $this->adminService->createAdmin($request->validated());
            session()->flash('success', 'Admin created successfully');
            return redirect()->route('am.admin.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return back()->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Admin $admin)
    {
        return response()->json($this->adminService->getDetails($admin));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin): View
    {
        return view('admin.admin-management.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin): RedirectResponse
    {
        try {
            $this->adminService->updateAdmin($admin, $request->validated());
            session()->flash('success', 'Admin updated successfully');
            return redirect()->route('am.admin.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin): RedirectResponse
    {
        try {
            $this->adminService->deleteAdmin($admin);
            session()->flash('success', 'Admin deleted successfully');
            return redirect()->route('am.admin.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong');
            return redirect()->route('am.admin.index');
        }
    }

    /**
     * Display the admin profile view.
     */

    public function profile()
    {
        $admin = $this->adminService->getDetails(admin());
        return view('admin.admin-management.admin.profile', compact('admin'));
    }

    public function updateProfile(AdminRequest $request): RedirectResponse
    {
        try {
            $this->adminService->updateAdmin(admin(), $request->validated());
            session()->flash('success', 'Profile updated successfully');
            return Redirect::route('am.admin.profile');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return back()->withInput();
        }
    }

    /**
     * Update the admin profile.
     */
    public function status(Admin $admin): RedirectResponse
    {
        try {
            $this->adminService->statusChange($admin);
            session()->flash('success', 'Admin status updated successfully');
            return redirect()->route('am.admin.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return redirect()->route('am.admin.index');
        }
    }
}
