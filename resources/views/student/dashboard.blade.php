@extends('student.layouts.master')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body mr-3">
                        <h2 class="fs-34 text-black font-w600">{{ $availableJobs ?? 0 }}</h2>
                        <span>Available Jobs</span>
                    </div>
                    <i class="flaticon-381-briefcase fs-45 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body mr-3">
                        <h2 class="fs-34 text-black font-w600">{{ $appliedJobs ?? 0 }}</h2>
                        <span>Applied Jobs</span>
                    </div>
                    <i class="flaticon-381-file fs-45 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body mr-3">
                        <h2 class="fs-34 text-black font-w600">{{ $upcomingJobFairs ?? 0 }}</h2>
                        <span>Upcoming Job Fairs</span>
                    </div>
                    <i class="flaticon-381-calendar fs-45 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body mr-3">
                        <h2 class="fs-34 text-black font-w600">{{ $interviews ?? 0 }}</h2>
                        <span>Scheduled Interviews</span>
                    </div>
                    <i class="flaticon-381-user fs-45 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="card-title">Recent Job Applications</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th><strong>JOB TITLE</strong></th>
                                <th><strong>COMPANY</strong></th>
                                <th><strong>APPLIED DATE</strong></th>
                                <th><strong>STATUS</strong></th>
                                <th><strong>ACTION</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentApplications ?? [] as $application)
                            <tr>
                                <td>{{ $application->job->title }}</td>
                                <td>{{ $application->job->company->name }}</td>
                                <td>{{ $application->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge light badge-{{ $application->status_color }}">
                                        {{ $application->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('student.jobs.show', $application->job->id) }}" 
                                       class="btn btn-primary shadow btn-xs sharp mr-1">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No recent applications found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
