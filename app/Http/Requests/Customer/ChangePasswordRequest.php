<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
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
        $rules = ['password' => 'required|string|min:8|confirmed'];
        if (auth()->user()->password) {
            $rules = array_merge($rules, [
                'oldpassword' => 'required|string|min:8'
            ]);
        }
        return $rules;
    }

    public function messages()
    {
        return [];
    }
}
