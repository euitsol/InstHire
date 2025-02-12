@extends('admin.layouts.master', ['page_slug' => 'profile'])
@section('title', 'Admin Profile')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="createAdmin" class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="card-title">{{ __($admin->name . ' Profile') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'am.admin.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('am.admin.profile.update', $admin->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Name') }}<span class="text-danger">*</span></label>
                                <input type="text" value="{{ $admin->name }}" class="form-control" name="name"
                                    required>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Image') }}</label>
                                <input type="file" accept="image/*" class="form-control" name="image">
                                @include('alerts.feedback', ['field' => 'image'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Email') }}<span class="text-danger">*</span></label>
                                <input type="email" value="{{ $admin->email }}" class="form-control" required disabled>
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Phone') }}</label>
                                <input type="text" min='11' max='11' pattern="[0-9]{11}"
                                    placeholder="Enter phone" value="{{ $admin->phone }}" class="form-control"
                                    name="phone">
                                @include('alerts.feedback', ['field' => 'phone'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Gender') }}</label>
                                <select class="form-control" name="gender">
                                    <option value=" " selected disabled>
                                        {{ __('Select Gender') }}</option>
                                    @foreach ($admin->gender_labels as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $admin->gender == $key ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'gender'])
                            </div>
                            <button type="submit" class="btn btn-primary float-end">{{ __('Update Profile') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
