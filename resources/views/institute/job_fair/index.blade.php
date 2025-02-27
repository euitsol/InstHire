@extends('institute.layouts.master')
@section('title', 'Job Fairs')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">{{ __('Job Fairs') }}</h4>
                <a href="{{ route('institute.jf.create') }}" class="btn btn-sm btn-primary">
                    {{ __('Create Job Fair') }}
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Start Date') }}</th>
                            <th scope="col">{{ __('End Date') }}</th>
                            <th scope="col">{{ __('Maximum Companies') }}</th>
                            <th scope="col">{{ __('Registered') }}</th>
                            <th scope="col">{{ __('Pending') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobFairs as $jobFair)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jobFair->title }}</td>
                                <td>{{ $jobFair->start_date->format('d M Y, h:i A') }}</td>
                                <td>{{ $jobFair->end_date->format('d M Y, h:i A') }}</td>
                                <td>{{ $jobFair->maximum_companies }}</td>
                                <td>{{ $jobFair->registered_employees_count }}</td>
                                <td>
                                    @if($jobFair->pending_registrations_count > 0)
                                        <span class="badge bg-warning">{{ $jobFair->pending_registrations_count }}</span>
                                    @else
                                        {{ $jobFair->pending_registrations_count }}
                                    @endif
                                </td>
                                <td>
                                    @if($jobFair->isUpcoming())
                                        <span class="badge bg-info">{{ __('Upcoming') }}</span>
                                    @elseif($jobFair->isOngoing())
                                        <span class="badge bg-success">{{ __('Ongoing') }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ __('Completed') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('institute.jf.show', $jobFair) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('institute.jf.edit', $jobFair) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('institute.jf.destroy', $jobFair) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this job fair?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">{{ __('No job fairs found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection