@extends('admin.layouts.master', ['page_slug' => 'employee'])
@section('title', 'Edit Employee')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h2 class="card-title">{{ __('Edit Employee') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'em.employee.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('em.employee.update', $employee->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input type="text" placeholder="Enter name" value="{{ $employee->name }}"
                                    class="form-control" name="name" required>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" placeholder="Enter email" value="{{ $employee->email }}"
                                    class="form-control" name="email" required>
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Password') }}</label>
                                <input type="password" placeholder="Enter password" class="form-control" name="password">
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" placeholder="Enter confirm password" class="form-control"
                                    name="password_confirmation">
                                @include('alerts.feedback', ['field' => 'password_confirmation'])
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle me-1"></i> {{ __('Update Employee') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
