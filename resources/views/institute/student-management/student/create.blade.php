@extends('institute.layouts.master')
@section('title', 'Student Create')
@section('content')
    <!-- Employee List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Student Create') }}</h2>
                <a href="{{ route('institute.student.index') }}" class="btn btn-sm btn-primary">
                 {{ __('Back') }}
                </a>
            </div>

            <form action="{{ route('institute.student.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Enter name"
                        id="name" name="name">
                    @include('alerts.feedback', ['field' => 'name'])
                </div>
                <div class="mb-3">
                    <label for="session_id" class="form-label">Session</label>
                    <select name="session_id" id="session_id" class="form-control">
                        <option value="" selected disabled>{{ __('Select Session') }}</option>
                        @foreach ($sessions as $session)
                            <option value="{{ $session->id }}" {{ old('session_id') == $session->id ? 'selected' : '' }}>
                                {{ $session->name }}
                            </option>
                        @endforeach
                    </select>
                    @include('alerts.feedback', ['field' => 'session_id'])
                </div>
                <div class="mb-3">
                    <label for="department_id" class="form-label">Department</label>
                    <select name="department_id" id="department_id" class="form-control">
                        <option value="" selected disabled>{{ __('Select Department') }}</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @include('alerts.feedback', ['field' => 'department_id'])
                </div>
                <div class="mb-3">
                    <label for="roll" class="form-label">Roll</label>
                    <input type="text" class="form-control" value="{{ old('roll') }}" placeholder="Enter roll"
                        id="roll" name="roll">
                    @include('alerts.feedback', ['field' => 'roll'])
                </div>
                {{-- <div class="mb-3">
                    <label for="registration" class="form-label">Registration</label>
                    <input type="text" class="form-control" value="{{ old('registration') }}"
                        placeholder="Enter registration" id="registration" name="registration">
                    @include('alerts.feedback', ['field' => 'registration'])
                </div> --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email"
                        id="email" name="email">
                    @include('alerts.feedback', ['field' => 'email'])
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" value="{{ old('phone') }}" placeholder="Enter phone"
                        id="phone" name="phone">
                    @include('alerts.feedback', ['field' => 'phone'])
                </div>


                <div class="mb-3">
                    <input type="submit" value="{{ __('Save') }}" class="btn btn-primary float-end">
                </div>


            </form>
        </div>
    </div>
@endsection
