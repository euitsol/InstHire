@extends('institute.layouts.master')

@section('title', 'Employee Profile')

@section('content')
    <div class="container-fluid p-4">
        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0">Employee Profile</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('institute.employee.index') }}" class="btn btn-sm btn-primary">
                    Back
                </a>
            </div>

        </div>

        <div class="row">
            <!-- Profile Card -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ $employee->image ? asset($employee->image) : asset('images/default-avatar.png') }}"
                            alt="{{ $employee->name }}" class="rounded-circle mb-3" width="150" height="150">
                        <h5>{{ $employee->name }}</h5>
                        <p class="text-muted mb-3">{{ $employee->email }}</p>
                        <div class="d-flex justify-content-center">
                            <span class="badge {{ $employee->status_badge_color }}">
                                {{ $employee->status_label }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Details Card -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Personal Information</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <p>{{ $employee->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <p>{{ $employee->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone</label>
                                <p>{{ $employee->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Gender</label>
                                <p><span class="badge {{ $employee->gender_badge_color }}">{{ $employee->gender_label }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Created At</label>
                                <p>{{ $employee->created_at->format('M d, Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Last Updated</label>
                                <p>{{ $employee->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="status_update text-end mt-3">
                @php
                    use App\Models\Employee;
                @endphp
                @if ($employee->status == Employee::STATUS_PENDING)
                    @include('institute.includes.button', [
                        'routeName' => 'institute.employee.status',
                        'label' => 'Accept',
                        'className' => 'btn-success',
                        'params' => [
                            'employee' => $employee->id,
                            'status' => Employee::STATUS_ACCEPTED,
                        ],
                    ])
                    @include('institute.includes.button', [
                        'routeName' => 'institute.employee.status',
                        'label' => 'Decline',
                        'className' => 'btn-danger',
                        'params' => [
                            'employee' => $employee->id,
                            'status' => Employee::STATUS_DECLINED,
                        ],
                    ])
                @elseif($employee->status == Employee::STATUS_ACCEPTED)
                    @include('institute.includes.button', [
                        'routeName' => 'institute.employee.status',
                        'label' => 'Decline',
                        'className' => 'btn-danger',
                        'params' => [
                            'employee' => $employee->id,
                            'status' => Employee::STATUS_DECLINED,
                        ],
                    ])
                @endif
            </div>
        </div>
    </div>
@endsection
