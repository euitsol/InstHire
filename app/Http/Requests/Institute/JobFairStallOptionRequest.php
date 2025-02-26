<?php

namespace App\Http\Requests\Institute;

use Illuminate\Foundation\Http\FormRequest;

class JobFairStallOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stall_size' => 'required|string|max:255',
            'maximum_representative' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'stall_size.required' => 'Stall size is required',
            'maximum_representative.required' => 'Maximum representative count is required',
            'maximum_representative.min' => 'Maximum representative must be at least 1'
        ];
    }
}
