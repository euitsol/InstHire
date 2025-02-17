@extends('admin.layouts.master', ['page_slug' => 'institute'])
@section('title', 'Edit Institute')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h2 class="card-title">{{ __('Edit Institute') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'im.institute.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('im.institute.update', $institute->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input type="text" placeholder="Enter name" value="{{ old('name') ?? $institute->name }}" class="form-control" name="name"
                                    required>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" placeholder="Enter email" value="{{ old('email') ?? $institute->email }}" class="form-control" name="email"
                                    required>
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Responsible Person Name') }}</label>
                                <input type="text" placeholder="Enter responsible person name" value="{{ old('responsible_person_name') ?? $institute->responsible_person_name }}" class="form-control" name="responsible_person_name"
                                    required>
                                @include('alerts.feedback', ['field' => 'responsible_person_name'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Responsible Person Phone') }}</label>
                                <input type="text" placeholder="Enter responsible person phone" value="{{ old('responsible_person_phone') ?? $institute->responsible_person_phone }}" class="form-control" name="responsible_person_phone"
                                    required>
                                @include('alerts.feedback', ['field' => 'responsible_person_phone'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Password') }}</label>
                                <input type="password" placeholder="Enter password" class="form-control" name="password">
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" placeholder="Enter confirm password" class="form-control" name="password_confirmation">
                                @include('alerts.feedback', ['field' => 'password_confirmation'])
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle me-1"></i> {{ __('Update Institute') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
