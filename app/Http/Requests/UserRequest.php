<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'nullable|min:3',
            'avatar' => 'nullable|image',
            'current_password' => 'nullable|string|min:6',
            'password' => 'nullable|required_with:current_password|string|min:6|confirmed',
        ];
    }

}
