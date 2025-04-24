<?php

namespace Modules\Dashboard\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('permission');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions', 'name')->ignore($id)],
            'display_name' => ['required', 'string', 'max:255', Rule::unique('permissions', 'display_name')->ignore($id)],
            'description' => ['required', 'string', 'max:255', Rule::unique('permissions', 'description')->ignore($id)],
        ];

    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
