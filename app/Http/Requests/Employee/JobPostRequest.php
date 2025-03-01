<?php

namespace App\Http\Requests\Employee;

use App\Models\JobPost;
use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:job_categories,id'],
            'visibility' => ['required', Rule::in([JobPost::VISIBLE_PUBLIC, JobPost::VISIBLE_INSTITUTE])],
            'institute_id' => [
                Rule::requiredIf(fn() => $this->visibility == JobPost::VISIBLE_INSTITUTE),
                'sometimes','exists:institutes,id'
            ],
            'type' => ['required', Rule::in([JobPost::TYPE_SELF, JobPost::TYPE_EXTERNAL])],
            'application_url' => [
                Rule::requiredIf(fn() => $this->type == JobPost::TYPE_EXTERNAL),
                'nullable',
                'url',
                'max:255'
            ],
            'email' => ['required', 'email', 'max:255'],
            'job_type' => ['required', Rule::in([
                JobPost::FULL_TIME,
                JobPost::PART_TIME,
                JobPost::WORK_FROM_HOME,
                JobPost::CONTRACTUAL,
                JobPost::INTERN
            ])],
            'salary_type' => ['required', Rule::in([
                JobPost::SALARY_PER_MONTH,
                JobPost::SALARY_PER_YEAR,
                JobPost::SALARY_NEGOTIABLE
            ])],
            'salary' => [
                Rule::requiredIf(fn() => $this->salary_type != JobPost::SALARY_NEGOTIABLE),
                'numeric',
                'min:0'
            ],
            'deadline' => ['required', 'date', 'after:today'],
            'vacancy' => ['required', 'integer', 'min:1'],
            'company_address' => ['required', 'string'],
            'job_responsibility' => ['required', 'string'],
            'additional_requirement' => ['nullable', 'string'],
            'job_location' => ['required', 'string'],
            'other_benefits' => ['nullable', 'string'],
            'special_instractions' => ['nullable', 'string'],
            'educational_requirement' => ['required', 'string'],
            'professional_requirement' => ['nullable', 'string'],
            'experience_requirement' => ['nullable', 'string'],
            'age_requirement' => ['nullable', 'string'],
        ];
    }
}
