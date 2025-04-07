<?php

namespace Modules\Dashboard\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegister extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'store_name'=> 'required|string|max:255',
            'description'=> 'nullable|string|max:255',
            // Add any other fields you need to validate
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email has already been taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'store_name.required' => 'Store name is required',
            'store_name.string' => 'Store name must be a string',
            'store_name.max' => 'Store name must not exceed 255 characters',
            'description.string' => 'Description must be a string',
            'description.max' => 'Description must not exceed 255 characters',
            'phone.string' => 'Phone number must be a string',
            'phone.max' => 'Phone number must not exceed 15 characters',
            'address.string' => 'Address must be a string',
            'address.max' => 'Address must not exceed 255 characters',
            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string', 
            // Add any other custom messages you need
        ];
    }
}
