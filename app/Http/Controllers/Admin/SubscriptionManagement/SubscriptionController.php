<?php

namespace App\Http\Controllers\Admin\SubscriptionManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class SubscriptionController extends Controller
{
    protected SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->middleware('auth:admin');
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $subscriptions = $this->subscriptionService->getSubscriptions();
        return view('admin.subscription-management.subscription.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.subscription-management.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request): RedirectResponse
    {
        try {
            $this->subscriptionService->create($request->validated());
            session()->flash('success', 'Subscription created successfully');
            return redirect()->route('sm.subscription.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return back()->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Subscription $subscription): JsonResponse
    {
        return response()->json($this->subscriptionService->getDetails($subscription));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription): View
    {
        return view('admin.subscription-management.subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, Subscription $subscription): RedirectResponse
    {
        try {
            $this->subscriptionService->update($subscription, $request->validated());
            session()->flash('success', 'Subscription updated successfully');
            return redirect()->route('sm.subscription.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription): RedirectResponse
    {
        try {
            $this->subscriptionService->delete($subscription);
            session()->flash('success', 'Subscription deleted successfully');
            return redirect()->route('sm.subscription.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return redirect()->route('sm.subscription.index');
        }
    }
    /**
     * Update the admin profile.
     */
    public function status(Subscription $subscription): RedirectResponse
    {
        try {
            $this->subscriptionService->statusChange($subscription);
            session()->flash('success', 'Subscription status updated successfully');
            return redirect()->route('sm.subscription.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, please try again');
            return redirect()->route('sm.subscription.index');
        }
    }
}
