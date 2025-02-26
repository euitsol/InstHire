@extends('institute.layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0">Profile</h1>
        </div>

        <!-- Profile Form -->
        <div class="row g-4">
            <div class="col-lg-12">
                <form action="{{ route('institute.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title mb-1">Profile Information</h4>
                            <p class="text-muted mb-0">Update your institute's profile information.</p>
                        </div>
                        <div class="card-body">
                            <!-- Institute Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label">Institute Name</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', auth()->guard('institute')->user()->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', auth()->guard('institute')->user()->email) }}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                            <!-- Responsible Person Name -->
                            <div class="mb-4">
                                <label for="responsible_person_name" class="form-label">Responsible Person Name</label>
                                <input type="text" name="responsible_person_name" id="responsible_person_name"
                                    value="{{ old('responsible_person_name', auth()->guard('institute')->user()->responsible_person_name) }}"
                                    class="form-control @error('responsible_person_name') is-invalid @enderror">
                                @include('alerts.feedback', ['field' => 'responsible_person_name'])
                            </div>

                            <!-- Responsible Person Phone -->
                            <div class="mb-4">
                                <label for="responsible_person_phone" class="form-label">Contact Number</label>
                                <input type="text" name="responsible_person_phone" id="responsible_person_phone"
                                    value="{{ old('responsible_person_phone', auth()->guard('institute')->user()->responsible_person_phone) }}"
                                    class="form-control @error('responsible_person_phone') is-invalid @enderror">
                                @include('alerts.feedback', ['field' => 'responsible_person_phone'])
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Account Actions -->
            {{-- <div class="col-lg-4">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title mb-0">Account Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <!-- Contact Support -->
                            <button class="btn btn-light d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" class="me-2 text-muted">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                    Contact Support
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" class="text-muted">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>

                            <!-- Delete Account -->
                            <button class="btn btn-danger-soft d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Delete Account
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
