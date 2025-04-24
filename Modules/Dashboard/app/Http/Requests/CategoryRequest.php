<?php

namespace Modules\Dashboard\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $category = $this->route('category'); // هذا يعيد كائن Category
        $id = is_object($category) ? $category->id : $category;

        return [
            'name' => 'required|string|max:255|unique:categories,name,'.$id,
            'description' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'code' => 'nullable|string|max:255|unique:categories,code,'.$id,

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
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 255 characters',
            'description.string' => 'Description must be a string',
            'description.max' => 'Description must not exceed 255 characters',
            'parent_id.exists' => 'Parent category must exist in the database',
            'image.image' => 'Image must be a valid image file',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif',
            'image.max' => 'Image must not exceed 2MB',
            // Add any other custom messages you need
        ];
    }
}
