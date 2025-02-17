@extends('admin.layouts.master', ['page_slug' => 'employee'])
@section('title', 'Create Employee')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h2 class="card-title">{{ __('Create Employee') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'em.employee.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('em.employee.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Verified By') }}</label>
                                <select name="verifier_id" class="form-select">
                                    <option value="" selected disabled>{{ __('Select Verified By') }}</option>
                                    @foreach ($institutes as $institute)
                                        <option value="{{ $institute->id }}" {{ old('verifier_id') == $institute->id ? 'selected' : '' }}>{{ $institute->name }}</option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'verifier_id'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input type="text" placeholder="Enter name" value="{{ old('name') }}" class="form-control" name="name"
                                    required>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" placeholder="Enter email" value="{{ old('email') }}" class="form-control" name="email"
                                    required>
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Password') }}</label>
                                <input type="password" placeholder="Enter password" class="form-control" name="password" required>
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" placeholder="Enter confirm password" class="form-control" name="password_confirmation" required>
                                @include('alerts.feedback', ['field' => 'password_confirmation'])
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle me-1"></i> {{ __('Create Employee') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
