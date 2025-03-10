<?php

namespace App\Http\Requests\Institute;

use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
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
        return [

            'status' => 'required|boolean',
        ] +
            ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    public function store(): array
    {
        return [
            'name' => 'required|string|max:255|unique:institute_sessions,name',
        ];
    }

    public function update(): array
    {
        return [
           'name'=> 'required|string|max:255|unique:institute_sessions,name,'.$this->route('session')->id,
        ];
    }

}
