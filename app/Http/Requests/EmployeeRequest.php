<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'sometimes',
                'email',
                Rule::unique('employees')->ignore($this->route('employee')),
            ],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'phone' => ['nullable', 'numeric', 'digits:11'],
            'gender' => ['nullable', Rule::in([Employee::GENDER_MALE, Employee::GENDER_FEMALE, Employee::GENDER_OTHERS])],
            'verifier_id' => ['nullable', 'exists:institutes,id'],

        ];

        if ($this->isMethod('POST')) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        } elseif ($this->filled('password')) {
            $rules['password'] = ['string', 'min:8', 'confirmed'];
        }
        return $rules;
    }
}
