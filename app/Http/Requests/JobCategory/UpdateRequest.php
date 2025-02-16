<?php

namespace App\Http\Requests\JobCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:job_categories,title,' . $this->jobCategory->id,
            'slug' => 'required|string|max:255|unique:job_categories,slug,' . $this->jobCategory->id
        ];
    }
}
