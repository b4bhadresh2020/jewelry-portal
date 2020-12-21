<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SellerRequest extends FormRequest
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
        $rules = ['title' => 'required', 'subtitle' => 'required'];
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
            'title.required'  => 'Title must be required',
            'subtitle.required'  => 'Subtitle must be required',
            'image.mimes'       => 'Image Type Invalid',
        ];
    }
}