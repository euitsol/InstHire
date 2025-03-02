@extends('employee.layouts.master')
@section('title', 'Edit Job Post')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">{{ __('Edit Job Post') }}</h4>
                <a href="{{ route('employee.job-posts.index') }}" class="btn btn-sm btn-primary">
                    {{ __('Back') }}
                </a>
            </div>

            <form action="{{ route('employee.job-posts.update', $jobPost->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Basic Information') }}</h5>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">{{ __('Job Title') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $jobPost->title) }}" required>
                                        @include('alerts.feedback', ['field' => 'title'])
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{ __('Company Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name', $jobPost->company_name) }}" required>
                                        @include('alerts.feedback', ['field' => 'company_name'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Category') }} <span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option value="">{{ __('Select Category') }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $jobPost->category_id) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        @include('alerts.feedback', ['field' => 'category_id'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Visibility') }} <span class="text-danger">*</span></label>
                                        <select name="visibility" id="visibility" class="form-select @error('visibility') is-invalid @enderror" required>
                                            <option value="">{{ __('Select Visibility') }}</option>
                                            <option value="{{ App\Models\JobPost::VISIBLE_PUBLIC }}" {{ old('visibility', $jobPost->visibility) == App\Models\JobPost::VISIBLE_PUBLIC ? 'selected' : '' }}>{{ __('Public') }}</option>
                                            <option value="{{ App\Models\JobPost::VISIBLE_INSTITUTE }}" {{ old('visibility', $jobPost->visibility) == App\Models\JobPost::VISIBLE_INSTITUTE ? 'selected' : '' }}>{{ __('Private') }}</option>
                                        </select>
                                        @include('alerts.feedback', ['field' => 'visibility'])
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">{{ __('Type') }} <span class="text-danger">*</span></label>
                                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                            <option value="">{{ __('Select Type') }}</option>
                                            <option value="{{ App\Models\JobPost::TYPE_SELF }}" {{ old('type', $jobPost->type) == App\Models\JobPost::TYPE_SELF ? 'selected' : '' }}>{{ __('Self') }}</option>
                                            <option value="{{ App\Models\JobPost::TYPE_EXTERNAL }}" {{ old('type', $jobPost->type) == App\Models\JobPost::TYPE_EXTERNAL ? 'selected' : '' }}>{{ __('External') }}</option>
                                        </select>
                                        @include('alerts.feedback', ['field' => 'type'])
                                    </div>
                                    <div class="col-12" id="application_url_input" style="display: {{ old('type', $jobPost->type) == App\Models\JobPost::TYPE_EXTERNAL ? 'block' : 'none' }}">
                                        <label class="form-label">{{ __('Application URL') }} <span class="text-danger">*</span></label>
                                        <input type="url" name="application_url" class="form-control @error('application_url') is-invalid @enderror" value="{{ old('application_url', $jobPost->application_url) }}">
                                        @include('alerts.feedback', ['field' => 'application_url'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Job Type') }} <span class="text-danger">*</span></label>
                                        <select name="job_type" class="form-select @error('job_type') is-invalid @enderror" required>
                                            <option value="">{{ __('Select Job Type') }}</option>
                                            <option value="{{ App\Models\JobPost::FULL_TIME }}" {{ old('job_type', $jobPost->job_type) == App\Models\JobPost::FULL_TIME ? 'selected' : '' }}>{{ __('Full Time') }}</option>
                                            <option value="{{ App\Models\JobPost::PART_TIME }}" {{ old('job_type', $jobPost->job_type) == App\Models\JobPost::PART_TIME ? 'selected' : '' }}>{{ __('Part Time') }}</option>
                                            <option value="{{ App\Models\JobPost::WORK_FROM_HOME }}" {{ old('job_type', $jobPost->job_type) == App\Models\JobPost::WORK_FROM_HOME ? 'selected' : '' }}>{{ __('Work From Home') }}</option>
                                            <option value="{{ App\Models\JobPost::CONTRACTUAL }}" {{ old('job_type', $jobPost->job_type) == App\Models\JobPost::CONTRACTUAL ? 'selected' : '' }}>{{ __('Contractual') }}</option>
                                            <option value="{{ App\Models\JobPost::INTERN }}" {{ old('job_type', $jobPost->job_type) == App\Models\JobPost::INTERN ? 'selected' : '' }}>{{ __('Intern') }}</option>
                                        </select>
                                        @include('alerts.feedback', ['field' => 'job_type'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $jobPost->email) }}" required>
                                        @include('alerts.feedback', ['field' => 'email'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Job Details') }}</h5>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Salary Type') }} <span class="text-danger">*</span></label>
                                        <select name="salary_type" id="salary_type" class="form-select @error('salary_type') is-invalid @enderror" required>
                                            <option value="">{{ __('Select Salary Type') }}</option>
                                            <option value="{{ App\Models\JobPost::SALARY_PER_MONTH }}" {{ old('salary_type', $jobPost->salary_type) == App\Models\JobPost::SALARY_PER_MONTH ? 'selected' : '' }}>{{ __('Per Month') }}</option>
                                            <option value="{{ App\Models\JobPost::SALARY_PER_YEAR }}" {{ old('salary_type', $jobPost->salary_type) == App\Models\JobPost::SALARY_PER_YEAR ? 'selected' : '' }}>{{ __('Per Year') }}</option>
                                            <option value="{{ App\Models\JobPost::SALARY_NEGOTIABLE }}" {{ old('salary_type', $jobPost->salary_type) == App\Models\JobPost::SALARY_NEGOTIABLE ? 'selected' : '' }}>{{ __('Negotiable') }}</option>
                                        </select>
                                        @include('alerts.feedback', ['field' => 'salary_type'])
                                    </div>

                                    <div class="col-md-6" id="salary_field">
                                        <label class="form-label">{{ __('Salary') }} <span class="text-danger salary-required">*</span></label>
                                        <input type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary', $jobPost->salary) }}" step="0.01">
                                        @include('alerts.feedback', ['field' => 'salary'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Deadline') }} <span class="text-danger">*</span></label>
                                        <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline', date('Y-m-d', strtotime($jobPost->deadline))) }}" required>
                                        @include('alerts.feedback', ['field' => 'deadline'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Vacancy') }} <span class="text-danger">*</span></label>
                                        <input type="number" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror" value="{{ old('vacancy', $jobPost->vacancy) }}" required>
                                        @include('alerts.feedback', ['field' => 'vacancy'])
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{ __('Job Location') }} <span class="text-danger">*</span></label>
                                        <textarea name="job_location" class="form-control @error('job_location') is-invalid @enderror" required>{{ old('job_location', $jobPost->job_location) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'job_location'])
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{ __('Company Address') }} <span class="text-danger">*</span></label>
                                        <textarea name="company_address" class="form-control @error('company_address') is-invalid @enderror" required>{{ old('company_address', $jobPost->company_address) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'company_address'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Requirements & Benefits') }}</h5>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Job Responsibility') }} <span class="text-danger">*</span></label>
                                        <textarea name="job_responsibility" rows="10" class="form-control @error('job_responsibility') is-invalid @enderror" required>{{ old('job_responsibility', $jobPost->job_responsibility) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'job_responsibility'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Educational Requirements') }}</label>
                                        <textarea name="educational_requirement" rows="10" class="form-control @error('educational_requirement') is-invalid @enderror">{{ old('educational_requirement', $jobPost->educational_requirement) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'educational_requirement'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Professional Requirements') }}</label>
                                        <textarea name="professional_requirement" rows="10" class="form-control @error('professional_requirement') is-invalid @enderror">{{ old('professional_requirement', $jobPost->professional_requirement) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'professional_requirement'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Experience Requirements') }}</label>
                                        <textarea name="experience_requirement" rows="10" class="form-control @error('experience_requirement') is-invalid @enderror">{{ old('experience_requirement', $jobPost->experience_requirement) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'experience_requirement'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Age Requirements') }}</label>
                                        <textarea name="age_requirement" rows="10" class="form-control @error('age_requirement') is-invalid @enderror">{{ old('age_requirement', $jobPost->age_requirement) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'age_requirement'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Additional Requirements') }}</label>
                                        <textarea name="additional_requirement" rows="10" class="form-control @error('additional_requirement') is-invalid @enderror">{{ old('additional_requirement', $jobPost->additional_requirement) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'additional_requirement'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Other Benefits') }}</label>
                                        <textarea name="other_benefits" rows="10" class="form-control @error('other_benefits') is-invalid @enderror">{{ old('other_benefits', $jobPost->other_benefits) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'other_benefits'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Special Instructions') }}</label>
                                        <textarea name="special_instractions" rows="10" class="form-control @error('special_instractions') is-invalid @enderror">{{ old('special_instractions', $jobPost->special_instractions) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'special_instractions'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">{{ __('Update Job Post') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Handle type change
            $('#type').change(function() {
                var type = $(this).val();
                if (type == {{ App\Models\JobPost::TYPE_SELF }}) {
                    // $('#employee_select').show();
                    // $('#employee_select select').prop('required', true);
                    $('#application_url_input').hide();
                    $('#application_url_input input').prop('required', false);
                } else if (type == {{ App\Models\JobPost::TYPE_EXTERNAL }}) {
                    // $('#employee_select').hide();
                    // $('#employee_select select').prop('required', false);
                    $('#application_url_input').show();
                    $('#application_url_input input').prop('required', true);
                } else {
                    // $('#employee_select').hide();
                    // $('#employee_select select').prop('required', false);
                    $('#application_url_input').hide();
                    $('#application_url_input input').prop('required', false);
                }
            }).trigger('change');

            // Handle salary type change
            $('#salary_type').change(function() {
                var salaryType = $(this).val();
                var salaryField = $('#salary_field');

                if (salaryType == {{ App\Models\JobPost::SALARY_NEGOTIABLE }}) {
                    salaryField.find('input').prop('disabled', true).prop('required', false).val('');
                    salaryField.find('.salary-required').hide();
                } else {
                    salaryField.find('input').prop('disabled', false).prop('required', true);
                    salaryField.find('.salary-required').show();
                }
            }).trigger('change');
        });
    </script>
@endpush
