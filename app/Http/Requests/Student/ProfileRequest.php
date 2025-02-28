<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends FormRequest
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
        $student = auth()->guard('student')->user();

        if ($this->filled('name')) {
            $rules = ['name' => ['required', 'string', 'max:255'],];
        }
        if($this->filled('email')) {
            $rules = ['email' => ['required', 'string', 'email', 'max:255', Rule::unique('students')->ignore($student->id)],];
        }
        if($this->filled('phone')) {
            $rules = ['phone' => ['required', 'string', 'max:20', Rule::unique('students')->ignore($student->id)]];
        }
        if($this->filled('gender')) {
            $rules = ['gender' => ['required', 'integer', 'in:1,2,3']];

        }
        if($this->filled('roll') || $this->filled('registration')) {
            $rules = [
                'roll' => ['nullable', 'string', 'max:50'],
                'registration' => ['nullable', 'string', 'max:50']
            ];
        }
        if($this->filled('image')) {
            $rules = ['image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']];
        }


        // Add password validation rules if password fields are present
        if ($this->filled('current_password')) {
            $rules['current_password'] = ['required', 'string', function ($attribute, $value, $fail) use ($student) {
                if (!Hash::check($value, $student->password)) {
                    $fail('The current password is incorrect.');
                }
            }];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'phone.required' => 'Please enter your phone number.',
            'gender.required' => 'Please select your gender.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
            'current_password.required' => 'Please enter your current password.',
            'password.required' => 'Please enter a new password.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
