@extends('admin.layouts.master', ['page_slug' => 'job-category'])

@section('title', 'Create Job Category')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="createJobCategory" class="card mb-4">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h2 class="card-title">{{ __('Create Job Category') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'jc.job-category.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('jc.job-category.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Title') }}</label>
                                <input type="text" value="{{ old('title') }}" class="form-control" name="title"
                                    required>
                                @include('alerts.feedback', ['field' => 'title'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Slug') }}</label>
                                <input type="text" value="{{ old('slug') }}" class="form-control" name="slug"
                                    required>
                                @include('alerts.feedback', ['field' => 'slug'])
                            </div>
                            <button type="submit" class="btn btn-primary float-end">{{ __('Create Job Category') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
