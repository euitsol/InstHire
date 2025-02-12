@extends('admin.layouts.master', ['page_slug' => 'admin'])
@section('title', 'Edit Admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="createAdmin" class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2 class="card-title">{{ __('Edit Admin') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'am.admin.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('am.admin.update', $admin->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input type="text" value="{{ $admin->name }}" class="form-control" name="name"
                                    required>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" value="{{ $admin->email }}" class="form-control" name="email"
                                    required>
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Password') }}</label>
                                <input type="password" class="form-control" name="password">
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" class="form-control" name="password_confirmation">
                                @include('alerts.feedback', ['field' => 'password_confirmation'])
                            </div>
                            <button type="submit" class="btn btn-primary float-end">{{ __('Update Admin') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
