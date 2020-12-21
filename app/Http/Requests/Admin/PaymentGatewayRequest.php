<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PaymentGatewayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'   => 'required',
            'key'       => 'required',
            'secret'       => 'required',
            'return_url'       => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'  => 'Name field required',
            'key.required'      => 'Key field required',
            'secret.required'      => 'Secret field required',
            'return_url.required'      => 'Return url field required',
        ];
    }
}