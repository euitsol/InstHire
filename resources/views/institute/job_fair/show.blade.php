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
                                        <th style="width: 200px;">{{ __('Title') }}</th>
                                        <td>{{ $jobFair->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Description') }}</th>
                                        <td>{{ $jobFair->description ?: __('No description provided.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Location') }}</th>
                                        <td>{{ $jobFair->location }}</td>
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
                                        <th>{{ __('Registered Employees') }}</th>
                                        <td>{{ $jobFair->registered_employees_count }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Pending Registrations') }}</th>
                                        <td>
                                            @if($jobFair->pending_registrations_count > 0)
                                                <span class="badge bg-warning">{{ $jobFair->pending_registrations_count }}</span>
                                            @else
                                                {{ $jobFair->pending_registrations_count }}
                                            @endif
                                        </td>
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
                                            <th>{{ __('Stall Size') }}</th>
                                            <th>{{ __('Max Representatives') }}</th>
                                            <th>{{ __('Description') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jobFair->stalls as $stall)
                                            <tr>
                                                <td>{{ $stall->stallOption->stall_size }}</td>
                                                <td>{{ $stall->stallOption->maximum_representative }}</td>
                                                <td>{{ $stall->stallOption->description }}</td>
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
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Employee Registrations') }}</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Employee') }}</th>
                                            <th>{{ __('Registration Date') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jobFair->registrations as $registration)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registration->employee->name }}</td>
                                                <td>{{ $registration->created_at->format('d M Y, h:i A') }}</td>
                                                <td>
                                                    @if($registration->status == 0)
                                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                    @elseif($registration->status == 1)
                                                        <span class="badge bg-success">{{ __('Accepted') }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ __('Declined') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="#" class="btn btn-sm btn-info">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        @if($registration->status == 0)
                                                            <button type="button" class="btn btn-sm btn-success approve-registration" data-id="{{ $registration->id }}">
                                                                <i class="bi bi-check-lg"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger reject-registration" data-id="{{ $registration->id }}">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">{{ __('No registrations found.') }}</td>
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle approve registration
        $('.approve-registration').click(function() {
            if (confirm('{{ __("Are you sure you want to approve this registration?") }}')) {
                const id = $(this).data('id');
                // Add your approval logic here
            }
        });

        // Handle reject registration
        $('.reject-registration').click(function() {
            if (confirm('{{ __("Are you sure you want to reject this registration?") }}')) {
                const id = $(this).data('id');
                // Add your rejection logic here
            }
        });
    });
</script>
@endpush
