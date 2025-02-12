<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Admin;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization should be handled via middleware
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'sometimes',
                'email',
                Rule::unique('admins')->ignore($this->route('admin')),
            ],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'phone' => ['nullable', 'numeric', 'digits:11'],
            'gender' => ['nullable', Rule::in([Admin::GENDER_MALE, Admin::GENDER_FEMALE, Admin::GENDER_OTHERS])],

        ];

        if ($this->isMethod('POST')) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        } elseif ($this->filled('password')) {
            $rules['password'] = ['string', 'min:8', 'confirmed'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
            'phone.digits' => 'The phone must be a 11-digit number.',
            'gender.in' => 'The gender field is invalid.',
        ];
    }
}
