<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string' ,
            'email'         => 'required|string|email|max:255|unique:users,email',
            'password'      => 'required|string|min:8',
        ];
    }

    public function messages(){
        return [

        ];
    }
}
