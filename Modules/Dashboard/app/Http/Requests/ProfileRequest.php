<?php

namespace Modules\Dashboard\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $user=Auth::guard('admin')->user();

        return [


            'name' => ['required','string','max:255'],
            'email' => ['required','string', 'email',
                Rule::unique('admins', 'email')->ignore($user->id)],
            'username'=> ['required','string','regex:/^[a-zA-Z][a-zA-Z0-9_]{2,29}$/','max:255', Rule::unique('admins', 'username')->ignore($user->id)],
            'phone'=> ['nullable' , 'numeric:digits_between:10,12'],
            'image'=> ['nullable', 'image','mimes:jpeg,png,jpg,gif,svg','max:2048']

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
