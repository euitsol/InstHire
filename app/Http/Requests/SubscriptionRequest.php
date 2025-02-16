<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assuming the auth middleware is handling the authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subscriptions')->ignore($this->subscription),
            ],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'validity' => ['required', 'integer', 'min:1', 'max:3650'], // Max 10 years
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Max 2MB
        ];

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => __('Title'),
            'price' => __('Price'),
            'validity' => __('Validity'),
            'description' => __('Description'),
            'status' => __('Status'),
            'image' => __('Image'),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => __('The subscription title is required.'),
            'title.unique' => __('This subscription title is already taken.'),
            'price.required' => __('The subscription price is required.'),
            'price.numeric' => __('The price must be a valid number.'),
            'price.min' => __('The price cannot be negative.'),
            'price.max' => __('The price cannot exceed :max.'),
            'validity.required' => __('The subscription validity period is required.'),
            'validity.integer' => __('The validity must be a whole number.'),
            'validity.min' => __('The validity period must be at least 1 day.'),
            'validity.max' => __('The validity period cannot exceed :max days.'),
            'image.image' => __('The file must be an image.'),
            'image.mimes' => __('The image must be a file of type: :values.'),
            'image.max' => __('The image size cannot exceed :max kilobytes.'),
        ];
    }
}
