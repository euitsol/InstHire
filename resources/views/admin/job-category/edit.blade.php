@extends('admin.layouts.master', ['page_slug' => 'job-category'])
@section('title', 'Edit Job Category')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="createJobCategory" class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2 class="card-title">{{ __('Edit Job Category') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'jc.job-category.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('jc.job-category.update', $jobCategory->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Title') }}</label>
                                <input type="text" value="{{ $jobCategory->title }}" class="form-control" name="title"
                                    required>
                                @include('alerts.feedback', ['field' => 'title'])
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Slug') }}</label>
                                <input type="text" value="{{ $jobCategory->slug }}" class="form-control" name="slug"
                                    required>
                                @include('alerts.feedback', ['field' => 'slug'])
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle me-1"></i> {{ __('Update Job Category') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
