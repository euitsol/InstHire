@extends('student.layouts.master')

@section('title', $jobFair->title)

@section('content')
<div class="px-4 container-fluid">
    <!-- Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0 text-gray-800 h3">Job Fair Details</h1>
            <p class="text-muted">View details and participating companies</p>
        </div>
        <div>
            <a href="{{ route('student.jf.index') }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-arrow-left"></i> Back to Job Fairs
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Job Fair Details -->
            <div class="mb-4 rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded bg-light me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-calendar-event text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 card-title">{{ $jobFair->title }}</h4>
                            <div>
                                <span class="badge bg-{{ $jobFair->status_color }}">{{ $jobFair->status_label }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="p-3 rounded-3 bg-light">
                                <h5 class="mb-3 h6 text-uppercase text-muted">Event Details</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-calendar-date text-primary me-2"></i>
                                        <span>Start: {{ date('M d, Y', strtotime($jobFair->start_date)) }}</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-calendar-date text-primary me-2"></i>
                                        <span>End: {{ date('M d, Y', strtotime($jobFair->end_date)) }}</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-geo-alt text-primary me-2"></i>
                                        <span>{{ $jobFair->location }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light">
                                <h5 class="mb-3 h6 text-uppercase text-muted">Participation</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-building text-primary me-2"></i>
                                        <span>{{ $registeredCompanies->count() }} / {{ $jobFair->maximum_companies }} Companies</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-people text-primary me-2"></i>
                                        <span>Open to all students</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="mb-3 h6 text-uppercase text-muted">Description</h5>
                        <div class="mb-4">
                            {!! nl2br(e($jobFair->description)) !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Participating Companies -->
            <div class="rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <h4 class="mb-0 card-title">Registered Participants</h4>
                </div>
                <div class="card-body">
                    @if($registeredCompanies->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Registration Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registeredCompanies as $index => $registration)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ date('M d, Y', strtotime($registration->created_at)) }}</td>
                                            <td>
                                                @if($registration->status == 1)
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($registration->status == 0)
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center">
                            <div class="mb-3">
                                <i class="bi bi-building text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5>No Registrations Yet</h5>
                            <p class="text-muted">There are currently no registrations for this job fair.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Event Timeline -->
            <div class="mb-4 rounded-xl shadow-sm card sticky-lg-top" style="top: 100px; z-index: 999;">
                <div class="py-3 bg-white card-header border-bottom">
                    <h4 class="mb-0 card-title">Event Timeline</h4>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @php
                            $now = now();
                            $startDate = \Carbon\Carbon::parse($jobFair->start_date);
                            $endDate = \Carbon\Carbon::parse($jobFair->end_date);
                            
                            $daysUntilStart = $now->diffInDays($startDate, false);
                            $daysUntilEnd = $now->diffInDays($endDate, false);
                            
                            $eventStarted = $daysUntilStart <= 0;
                            $eventEnded = $daysUntilEnd <= 0;
                        @endphp
                        
                        <div class="timeline-item {{ $eventStarted ? 'completed' : 'pending' }}">
                            <div class="timeline-marker {{ $eventStarted ? 'bg-success' : 'bg-light border' }}"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Event Start</h6>
                                <p class="mb-0 small text-muted">{{ date('M d, Y', strtotime($jobFair->start_date)) }}</p>
                                @if(!$eventStarted)
                                    <p class="mb-0 small text-primary">
                                        <i class="bi bi-clock me-1"></i> {{ abs($daysUntilStart) }} days to go
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="timeline-item {{ $eventEnded ? 'completed' : 'pending' }}">
                            <div class="timeline-marker {{ $eventEnded ? 'bg-success' : 'bg-light border' }}"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Event End</h6>
                                <p class="mb-0 small text-muted">{{ date('M d, Y', strtotime($jobFair->end_date)) }}</p>
                                @if($eventStarted && !$eventEnded)
                                    <p class="mb-0 small text-primary">
                                        <i class="bi bi-clock me-1"></i> {{ abs($daysUntilEnd) }} days remaining
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Institute Information -->
            <div class="rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <h4 class="mb-0 card-title">Organizer</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-3 rounded bg-light me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-building text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">{{ $jobFair->institute->name ?? 'Institute Name' }}</h5>
                            <p class="mb-0 text-muted small">Event Organizer</p>
                        </div>
                    </div>
                    
                    @if(isset($jobFair->institute->address))
                        <div class="mb-3">
                            <h6 class="mb-2 text-muted small text-uppercase">Address</h6>
                            <p class="mb-0">{{ $jobFair->institute->address }}</p>
                        </div>
                    @endif
                    
                    @if(isset($jobFair->institute->contact_email))
                        <div class="mb-3">
                            <h6 class="mb-2 text-muted small text-uppercase">Contact</h6>
                            <p class="mb-0">{{ $jobFair->institute->contact_email }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .timeline {
        position: relative;
        padding-left: 1.5rem;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        left: 0.5rem;
        top: 0;
        height: 100%;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    
    .timeline-marker {
        position: absolute;
        left: -1.5rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
    }
    
    .timeline-content {
        padding-left: 0.5rem;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
</style>
@endpush
