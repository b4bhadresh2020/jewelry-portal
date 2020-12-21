<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class SignuInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'email'         => 'required|string|email|max:255|exists:users,email',
            'password'      => 'required|string|min:8',
        ];
    }

    public function messages(){
        return [

        ];
    }
}
