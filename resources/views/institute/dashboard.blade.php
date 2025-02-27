@extends('institute.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Dashboard</h1>
            <a href="{{ route('institute.job-post.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" class="me-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create Job Post
            </a>
        </div>


        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body p-4">
                        @if($currentSubscription)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Subscription Details</h5>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="subscription-icon me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-muted mb-1">Plan</h6>
                                            <p class="h5 mb-0">{{ $currentSubscription->subscription->title }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="subscription-icon me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-muted mb-1">Start Date</h6>
                                            <p class="h5 mb-0">{{ $currentSubscription->created_at->format('d M, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="subscription-icon me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-muted mb-1">Valid Until</h6>
                                            <p class="h5 mb-0">{{ institute()->valid_to ? date('d M, Y', strtotime(institute()->valid_to)) : 'Lifetime' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="subscription-icon me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-muted mb-1">Status</h6>
                                            <p class="h5 mb-0"><span class="{{ $currentSubscription->status_badge_color }} px-3 py-2">{{ $currentSubscription->status_label }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- @else
                            <div class="text-center py-4">
                                <div class="subscription-icon mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-warning">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h5 class="mb-3">No Active Subscription</h5>
                                <p class="text-muted mb-4">You currently don't have an active subscription. Subscribe to a plan to access all features.</p>
                                <a href="{{ route('institute.subscriptions.index') }}" class="btn btn-primary px-4">
                                    View Subscription Plans
                                </a>
                            </div> --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Job Posts -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stats-card h-100">
                    <div class="card-body">
                        <h6 class="title">Total Job Posts</h6>
                        <h2 class="value">0</h2>
                        {{-- <div class="trend up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                            </svg>
                            12% increase
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Active Jobs -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stats-card h-100">
                    <div class="card-body">
                        <h6 class="title">Active Jobs</h6>
                        <h2 class="value">0</h2>
                        {{-- <div class="trend up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                            </svg>
                            8% increase
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Total Applications -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stats-card h-100">
                    <div class="card-body">
                        <h6 class="title">Total Applications</h6>
                        <h2 class="value">0</h2>
                        {{-- <div class="trend down">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l5.94-2.28m-5.94 2.28l-2.28 5.941" />
                            </svg>
                            3% decrease
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Hired Candidates -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stats-card h-100">
                    <div class="card-body">
                        <h6 class="title">Total Employees</h6>
                        <h2 class="value">0</h2>
                        {{-- <div class="trend up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                            </svg>
                            15% increase
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        {{-- <div class="row g-4">
            <!-- Recent Activity -->
            <div class="col-12 col-lg-8">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <span class="badge badge-success rounded-pill">New</span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">New application received for Senior Developer position</h6>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item px-0">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <span class="badge badge-primary rounded-pill">Update</span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Interview scheduled with John Doe</h6>
                                        <small class="text-muted">5 hours ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="#" class="quick-action">
                                <span>Post a New Job</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                            <a href="#" class="quick-action">
                                <span>View Applications</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                            <a href="#" class="quick-action">
                                <span>Schedule Interviews</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                            <a href="#" class="quick-action danger">
                                <span>Delete Account</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
