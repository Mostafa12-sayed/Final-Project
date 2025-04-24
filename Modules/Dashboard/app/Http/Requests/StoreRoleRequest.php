<?php

namespace Modules\Dashboard\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:150',
            'display_name' => 'required|string|max:150',
            'description' => 'nullable|string|max:150',
            'role_status' => 'required',
            'permissions' => 'required|array',
        ];
    }
}
