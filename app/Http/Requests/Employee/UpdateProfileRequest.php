<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('employee')->check();
    }

    public function rules(): array
    {
        $employee = Auth::guard('employee')->user();
        
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees,email,' . $employee->id],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'gender' => ['required', 'in:male,female,other'],
        ];
    }
}
