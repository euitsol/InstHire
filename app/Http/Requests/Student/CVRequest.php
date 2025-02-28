<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class CVRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guard('student')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Please provide a title for your CV',
            'cv_file.required' => 'Please upload a CV file',
            'cv_file.file' => 'The CV must be a file',
            'cv_file.mimes' => 'The CV must be a PDF, DOC, or DOCX file',
            'cv_file.max' => 'The CV file size must not exceed 5MB',
        ];
    }
}
