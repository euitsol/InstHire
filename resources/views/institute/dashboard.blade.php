@extends('institute.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Dashboard</h1>
        <div class="d-flex gap-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card stats-card">
                <div class="title">Account Status</div>
                <div class="value">Active</div>
                <div class="trend up">
                    <i class="fas fa-check-circle me-1"></i>
                    Valid until {{ auth()->guard('institute')->user()->valid_to->format('M d, Y') }}
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card stats-card">
                <div class="title">Profile Completion</div>
                <div class="value">80%</div>
                <div class="trend up">
                    <i class="fas fa-arrow-up me-1"></i>
                    Complete your profile
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card stats-card">
                <div class="title">Last Login</div>
                <div class="value">{{ auth()->guard('institute')->user()->updated_at->format('M d, Y') }}</div>
                <div class="trend">
                    <i class="fas fa-clock me-1"></i>
                    {{ auth()->guard('institute')->user()->updated_at->format('h:i A') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row g-3">
        <!-- Profile Overview -->
        <div class="col-12 col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">Profile Overview</h5>
                    <a href="{{ route('institute.profile') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit Profile
                    </a>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Institute Name</label>
                                <p class="mb-0">{{ auth()->guard('institute')->user()->name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Email Address</label>
                                <p class="mb-0">{{ auth()->guard('institute')->user()->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Responsible Person</label>
                                <p class="mb-0">{{ auth()->guard('institute')->user()->responsible_person_name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Contact Number</label>
                                <p class="mb-0">{{ auth()->guard('institute')->user()->responsible_person_phone }}</p>
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
                    <h5 class="card-title">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('institute.profile') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user-edit me-2"></i>Update Profile
                        </a>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Contact Support
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-book me-2"></i>View Documentation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
