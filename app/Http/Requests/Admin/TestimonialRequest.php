<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TestimonialRequest extends FormRequest
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
            'name:en' => 'required',
            'role:en' => 'required'
        ];
        if ($this->method(true) === "POST") {
            $rules = array_merge($rules, [
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            ]);
        } else {
            $rules = array_merge($rules, [
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
            ]);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name:en.required'  => 'English name field must be required',
            'role:en.required'  => 'English role field must be required',
            'image.mimes'       => 'Image type invalid',
        ];
    }
}
