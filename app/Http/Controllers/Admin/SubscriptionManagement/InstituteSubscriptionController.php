<?php

namespace App\Http\Controllers\Admin\SubscriptionManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstituteSubscriptionRequest;
use App\Models\Institute;
use App\Models\InstituteSubscription;
use App\Models\Subscription;
use App\Services\InstituteSubscriptionService;
use Illuminate\Http\Request;

class InstituteSubscriptionController extends Controller
{
    protected $service;

    public function __construct(InstituteSubscriptionService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instituteSubscriptions = $this->service->getAll();
        return view('admin.subscription-management.institute-subscription.index', compact('instituteSubscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutes = Institute::pluck('name', 'id');
        $subscriptions = Subscription::pluck('title', 'id');
        return view('admin.subscription-management.institute-subscription.create', compact('institutes', 'subscriptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstituteSubscriptionRequest $request)
    {
        try {
            $data['creater_id'] = admin()->id;
            $data['creater_type'] = get_class(admin());
            $this->service->create(array_merge($request->validated(), $data));
            return redirect()->route('sm.institute-subscription.index')->with('success', 'Institute subscription created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InstituteSubscription $instituteSubscription)
    {
        return view('admin.subscription-management.institute-subscription.show', compact('instituteSubscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstituteSubscription $instituteSubscription)
    {
        $institutes = Institute::pluck('name', 'id');
        $subscriptions = Subscription::pluck('title', 'id');
        return view('admin.subscription-management.institute-subscription.edit', compact('instituteSubscription', 'institutes', 'subscriptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstituteSubscriptionRequest $request, InstituteSubscription $instituteSubscription)
    {
        try {
            $data['updater_id'] = admin()->id;
            $data['updater_type'] = get_class(admin());
            $this->service->update($instituteSubscription, array_merge($request->validated(), $data));
            return redirect()->route('sm.institute-subscription.index')->with('success', 'Institute subscription updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstituteSubscription $instituteSubscription)
    {
        try {
            $this->service->delete($instituteSubscription);
            return redirect()->route('sm.institute-subscription.index')->with('success', 'Institute subscription deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    /**
     * Change the status of the specified resource.
     */
    public function status(InstituteSubscription $instituteSubscription)
    {
        try {
            // Set all subscriptions of this institute to previous
            InstituteSubscription::where('institute_id', $instituteSubscription->institute_id)
                ->where('status', 1)
                ->update(['status' => 0]);

            // Set this subscription as current
            $instituteSubscription->update(['status' => 1]);

            return redirect()->route('sm.institute-subscription.index')
                ->with('success', 'Subscription status changed to current successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }
}
