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
            'valid_to' => ['nullable', 'numeric'],
            'responsible_person_name' => ['required', 'string', 'max:255'],
            'responsible_person_phone' => ['required', 'numeric', 'digits:11'],
        ];

        if ($this->isMethod('POST')) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:institutes,email'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed', Password::defaults()];
        }

        if ($this->isMethod('PUT')) {
            $rules['email'] = ['string', 'email', 'max:255', 'unique:institutes,email,' . $this->route('institute')->id];
            if($this->filled('password')){
                $rules['password'] = ['string', 'min:8', 'confirmed', Password::defaults()];
            }
        }

        return $rules;
    }
}
