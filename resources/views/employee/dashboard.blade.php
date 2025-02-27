@extends('employee.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-4">
    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-4" style="width: 64px; height: 64px;">
                            @if(auth()->guard('employee')->user()->image)
                                <img src="{{ asset('storage/'.auth()->guard('employee')->user()->image) }}" 
                                    alt="{{ auth()->guard('employee')->user()->name }}"
                                    class="rounded-circle">
                            @else
                                <div class="avatar-placeholder rounded-circle bg-white text-primary d-flex align-items-center justify-content-center"
                                    style="width: 64px; height: 64px; font-size: 24px;">
                                    {{ substr(auth()->guard('employee')->user()->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="mb-1">Welcome back, {{ auth()->guard('employee')->user()->name }}!</h4>
                            <p class="mb-0 text-white-50">{{ now()->format('l, F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">
        <!-- Total Jobs Available -->
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Available Jobs</p>
                            <h3 class="mb-0">{{ $totalJobs }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">System Status</p>
                            <h3 class="mb-0">Active</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
