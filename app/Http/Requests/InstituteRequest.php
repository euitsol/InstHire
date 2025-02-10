<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class InstituteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'valid_to' => ['required', 'date', 'after:today'],
            'responsible_person_name' => ['required', 'string', 'max:255'],
            'responsible_person_phone' => ['required', 'string', 'max:20'],
        ];

        if ($this->isMethod('POST')) {
            $rules['email'][] = 'unique:institutes';
            $rules['password'] = ['required', Password::defaults()];
        }

        if ($this->isMethod('PUT') && $this->filled('password')) {
            $rules['password'] = [Password::defaults()];
        }

        return $rules;
    }
}
