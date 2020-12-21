<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CustomSubCategoryRequest extends FormRequest
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
                'custom_category_id'   => 'required',
                'content:en'       => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'custom_category_id.required'  => 'Custom Category field required',
            'content:en.required'      => 'English field content must be required',
        ];
    }
}