<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        if (strtoupper($this->method()) === "POST") {
            return [
                'zipcode'           => 'required',
                'first_name'        => 'required',
                'phone'             => 'required',
                // 'type'              => 'required',
                'address_as'        => 'required',
                'city_id'           => 'required',
                'address_line_one'  => 'required'
            ];
        }
        return [];
    }

    public function messages()
    {
        return [];
    }
}
