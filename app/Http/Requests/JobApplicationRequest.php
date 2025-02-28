<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Anyone can apply for a job
    }

    public function rules(): array
    {
        $rules = [
            'applicant_name' => 'required|string|max:255',
            'applicant_email' => 'required|email|max:255',
            'applicant_phone' => 'required|string|max:20',
            'degree' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'result' => 'required|string|max:50',
            'cover_letter' => 'required|string',
            'cv_id' => 'nullable|exists:cvs,id'
        ];

        if($this->filled('cv_file')) {
            $rules['cv_file'] = 'required|file|mimes:pdf,doc,docx|max:5120';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'applicant_name.required' => 'Please enter your full name',
            'applicant_email.required' => 'Please enter your email address',
            'applicant_email.email' => 'Please enter a valid email address',
            'applicant_phone.required' => 'Please enter your phone number',
            'degree.required' => 'Please enter your degree',
            'institute.required' => 'Please enter your institute name',
            'result.required' => 'Please enter your result',
            'cover_letter.required' => 'Please provide a cover letter',
            'cv_id.exists' => 'The selected CV is invalid'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            'success' => false,
            'message' => implode(' ', $errors->all()),
            'token' => null,
        ], 422);
        throw new HttpResponseException($response);
    }


}
