<?php

namespace Modules\Dashboard\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'discount' => 'required|numeric',
            'description' => 'required|max:255',
            'is_active' => 'required',
            'expiry_date' => 'required|date',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter coupon name',
            'code.required' => 'Please enter coupon code',
            'discount.required' => 'Please enter coupon discount',
            'description.required' => 'Please enter coupon description',
            'is_active.required' => 'Please select coupon status',
            'expiry_date.required' => 'Please select coupon expiry date',
        ];
    }
}
