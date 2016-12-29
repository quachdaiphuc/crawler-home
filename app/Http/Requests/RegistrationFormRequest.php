<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistrationFormRequest extends Request
{
    /**
     * Determine if the member is authorized to make this request.
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
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email đã tồn tại',
            'password.confirmed' => 'password không giống nhau',
        ];
    }
}
