<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CustomCategoryRequest extends FormRequest
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

        if ($this->method(true) === "POST" || $this->method(true) === "PUT") {
            return [
                'name:en' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name:en.required' => 'English field name must be required',
        ];
    }
}