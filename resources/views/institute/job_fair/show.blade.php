@extends('institute.layouts.master')
@section('title', 'Job Fair Details')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">{{ __('Job Fair Details') }}</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('institute.jf.edit', $jobFair) }}" class="btn btn-sm btn-warning">
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('institute.jf.index') }}" class="btn btn-sm btn-primary">
                        {{ __('Back') }}
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Basic Information') }}</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>{{ __('Title') }}</th>
                                        <td>{{ $jobFair->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Description') }}</th>
                                        <td>{{ $jobFair->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Start Date') }}</th>
                                        <td>{{ $jobFair->start_date->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('End Date') }}</th>
                                        <td>{{ $jobFair->end_date->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Maximum Companies') }}</th>
                                        <td>{{ $jobFair->maximum_companies }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Status') }}</th>
                                        <td>
                                            @if($jobFair->isUpcoming())
                                                <span class="badge bg-info">{{ __('Upcoming') }}</span>
                                            @elseif($jobFair->isOngoing())
                                                <span class="badge bg-success">{{ __('Ongoing') }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ __('Completed') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Stall Options') }}</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Description') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jobFair->stallOptions as $option)
                                            <tr>
                                                <td>{{ $option->title }}</td>
                                                <td>{{ $option->price }}</td>
                                                <td>{{ $option->description }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">{{ __('No stall options found.') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Registered Companies') }}</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Company') }}</th>
                                            <th>{{ __('Stall Option') }}</th>
                                            <th>{{ __('Registration Date') }}</th>
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jobFair->registrations as $registration)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registration->company->name }}</td>
                                                <td>{{ $registration->stallOption->title }}</td>
                                                <td>{{ $registration->created_at->format('d M Y, h:i A') }}</td>
                                                <td>
                                                    @if($registration->status == 'pending')
                                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                    @elseif($registration->status == 'approved')
                                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">{{ __('No companies registered yet.') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
