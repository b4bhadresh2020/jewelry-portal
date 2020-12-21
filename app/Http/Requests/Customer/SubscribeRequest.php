<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email_subscribe'=> 'required|unique:subscribers',
        ];
    }

    public function messages(){
        return [
            'email_subscribe.required'=>"The email field is required.!"
        ];
    }
}
