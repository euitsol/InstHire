<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobFairRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:10000',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'maximum_companies' => 'required|integer|min:1',
            'stall_options' => 'required|array|min:1',
            'stall_options.*' => 'exists:job_fair_stall_options,id',
        ];

        return $rules;
    }
}
