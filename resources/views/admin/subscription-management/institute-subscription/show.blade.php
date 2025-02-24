@extends('admin.layouts.master', ['page_slug' => 'institute-subscription'])
@section('title', 'Institute Subscription Details')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title mb-0">{{ __('Institute Subscription Details') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'sm.institute-subscription.index',
                                'label' => 'Back',
                            ])
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold mb-4">{{ __('Institute Information') }}</h5>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <label class="text-muted"
                                                        style="width: 100px">{{ __('Name') }}</label>
                                                    <div class="flex-grow-1">{{ $instituteSubscription->institute->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <label class="text-muted"
                                                        style="width: 100px">{{ __('Email') }}</label>
                                                    <div class="flex-grow-1">{{ $instituteSubscription->institute->email }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <label class="text-muted"
                                                        style="width: 100px">{{ __('Responsible Person Name') }}</label>
                                                    <div class="flex-grow-1">
                                                        {{ $instituteSubscription->institute->responsible_person_name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <label class="text-muted"
                                                        style="width: 100px">{{ __('Responsible Person Phone') }}</label>
                                                    <div class="flex-grow-1">
                                                        {{ $instituteSubscription->institute->responsible_person_phone }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold mb-4">{{ __('Subscription Information') }}</h5>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <label class="text-muted"
                                                        style="width: 100px">{{ __('Title') }}</label>
                                                    <div class="flex-grow-1">
                                                        {{ $instituteSubscription->subscription->title }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <label class="text-muted"
                                                        style="width: 100px">{{ __('Price') }}</label>
                                                    <div class="flex-grow-1">
                                                        {{ $instituteSubscription->subscription->price }} BDT</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <label class="text-muted"
                                                        style="width: 100px">{{ __('Validity') }}</label>
                                                    <div class="flex-grow-1">
                                                        {{ $instituteSubscription->subscription->validity }} Days</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <label class="text-muted"
                                                        style="width: 100px">{{ __('Status') }}</label>
                                                    <div class="flex-grow-1">
                                                        <span class="{{ $instituteSubscription->status_badge_color }}">
                                                            {{ $instituteSubscription->status_label }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <label class="text-muted"
                                                        style="width: 100px">{{ __('Created At') }}</label>
                                                    <div class="flex-grow-1">
                                                        {{ $instituteSubscription->created_at->format('d M, Y h:i A') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
