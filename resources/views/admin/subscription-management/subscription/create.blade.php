@extends('admin.layouts.master', ['page_slug' => 'admin'])
@section('title', 'Create Admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="createAdmin" class="card mb-4">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h2 class="card-title">{{ __('Create Admin') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'am.admin.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('am.admin.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input type="text" value="{{ old('name') }}" class="form-control" name="name"
                                    required>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" value="{{ old('email') }}" class="form-control" name="email"
                                    required>
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Password') }}</label>
                                <input type="password" class="form-control" name="password" required>
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                                @include('alerts.feedback', ['field' => 'password_confirmation'])
                            </div>
                            <button type="submit" class="btn btn-primary float-end">{{ __('Create Admin') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
