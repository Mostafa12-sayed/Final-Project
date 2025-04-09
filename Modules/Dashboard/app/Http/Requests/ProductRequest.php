<?php

namespace Modules\Dashboard\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('product') ? $this->route('product')->id : null;
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'wight' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'code'=> 'required|string|max:255|unique:products,code,'.$id,
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            
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
            'name.required' => 'The name field is required.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'category_id.required' => 'The category field is required.',
            'images.*.image' => 'The file must be an image.',
            'images.*.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'images.*.max' => 'The image may not be greater than 2MB.',
            'code.required' => 'The code field is required.',
            'code.unique' => 'The code has already been taken.',
            'code.max' => 'The code may not be greater than 255 characters.',
            'quantity.required' => 'The quantity field is required.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity must be at least 0.',
            'wight.numeric' => 'The wight must be a number.',
            'wight.min' => 'The wight must be at least 0.',
            'tax.numeric' => 'The tax must be a number.',
            'tax.min' => 'The tax must be at least 0.',
            'discount.numeric' => 'The discount must be a number.', 
            'discount.min' => 'The discount must be at least 0.',
            'category_id.exists' => 'The selected category is invalid.',
            'images.array' => 'The images must be an array.',
            'images.*.image' => 'Each image must be an image.',
        ];
    }
}
