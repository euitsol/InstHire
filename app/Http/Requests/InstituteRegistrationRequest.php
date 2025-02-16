<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class InstituteRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:institutes'],
            'responsible_person_name' => ['required', 'string', 'max:255'],
            'responsible_person_phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Institute name is required',
            'email.unique' => 'This email is already registered',
            'responsible_person_name.required' => 'Responsible person name is required',
            'responsible_person_phone.required' => 'Responsible person phone number is required',
            'password.confirmed' => 'Password confirmation does not match',
        ];
    }
}
