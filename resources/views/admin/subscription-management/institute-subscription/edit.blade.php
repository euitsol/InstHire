@extends('admin.layouts.master', ['page_slug' => 'institute-subscription'])
@section('title', 'Edit Institute Subscription')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title mb-0">{{ __('Edit Institute Subscription') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'sm.institute-subscription.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('sm.institute-subscription.update', $instituteSubscription->id) }}"
                            method="POST">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label class="form-label">{{ __('Institute') }}</label>
                                <select class="form-select" name="institute_id" required>
                                    <option value="">{{ __('Select Institute') }}</option>
                                    @foreach ($institutes as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('institute_id', $instituteSubscription->institute_id) == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'institute_id'])
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('Subscription') }}</label>
                                <select class="form-select" name="subscription_id" required>
                                    <option value="">{{ __('Select Subscription') }}</option>
                                    @foreach ($subscriptions as $id => $title)
                                        <option value="{{ $id }}"
                                            {{ old('subscription_id', $instituteSubscription->subscription_id) == $id ? 'selected' : '' }}>
                                            {{ $title }}
                                        </option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'subscription_id'])
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle me-1"></i> {{ __('Update Subscription') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
