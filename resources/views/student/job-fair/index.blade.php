@extends('student.layouts.master')

@section('title', 'Job Fairs')

@section('content')
<div class="px-4 container-fluid">
    <!-- Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0 text-gray-800 h3">Job Fairs</h1>
            <p class="text-muted">View upcoming and past job fairs at your institute</p>
        </div>
        <div>
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Job Fairs List -->
    <div class="mb-4 rounded-xl shadow-sm card">
        <div class="py-3 bg-white card-header border-bottom">
            <h4 class="mb-0 card-title">Available Job Fairs</h4>
        </div>
        <div class="card-body">
            @if($jobFairs->count() > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($jobFairs as $jobFair)
                        <div class="col">
                            <div class="h-100 border rounded-xl shadow-sm card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <span class="badge bg-{{ $jobFair->status_color }}">{{ $jobFair->status_label }}</span>
                                    </div>
                                    <h5 class="mb-2 card-title">{{ $jobFair->title }}</h5>
                                    <p class="mb-3 card-text text-muted">{{ Str::limit($jobFair->description, 100) }}</p>
                                    <div class="mb-3">
                                        <div class="mb-2 d-flex align-items-center">
                                            <i class="bi bi-calendar-event text-primary me-2"></i>
                                            <span>{{ date('M d, Y', strtotime($jobFair->start_date)) }} - {{ date('M d, Y', strtotime($jobFair->end_date)) }}</span>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center">
                                            <i class="bi bi-geo-alt text-primary me-2"></i>
                                            <span>{{ $jobFair->location }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-building text-primary me-2"></i>
                                            <span>{{ $jobFair->registrations->count() }} / {{ $jobFair->maximum_companies }} Companies</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('student.jf.show', $jobFair->slug) }}" class="btn btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-4 d-flex justify-content-center">
                    {{ $jobFairs->links() }}
                </div>
            @else
                <div class="p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No Job Fairs Available</h5>
                    <p class="text-muted">There are currently no job fairs scheduled at your institute.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
</style>
@endpush
