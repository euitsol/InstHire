<?php

namespace App\Http\Requests\Institute;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'institute_id' => ['required', 'sometimes', 'exists:institutes,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'session_id' => ['required', 'exists:institute_sessions,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'gender' => ['nullable', Rule::in([Student::GENDER_MALE, Student::GENDER_FEMALE, Student::GENDER_OTHERS])],
        ] +
            ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    public function store(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:students,phone'],
            'roll' => ['required', 'numeric', 'unique:students,roll'],
            'registration' => ['required', 'numeric', 'unique:students,registration'],
        ];
    }

    public function update(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'unique:students,email,' . $this->route('student')->id],
            'phone' => ['numeric', 'digits:11', 'unique:students,phone,' . $this->route('student')->id],
            'roll' => ['required', 'numeric', 'unique:students,roll,' . $this->route('student')->id],
            'registration' => ['required', 'numeric', 'unique:students,registration,' . $this->route('student')->id],
        ];
    }
}
