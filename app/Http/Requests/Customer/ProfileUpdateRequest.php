<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
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
            return  [
                'first_name' => 'required|string',
                'profile'    => 'mimes:jpeg,jpg,png,svg|sometimes|max:10000',
                'email'      => 'required|string|max:255|unique:users,email,' . Auth::id(),
            ];
        }
        return [];
    }

    public function messages()
    {
        return [];
    }
}
