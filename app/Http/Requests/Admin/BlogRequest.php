<?php

namespace App\Http\Requests\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        $rules =[];
        if ($this->method(true) === "POST") {
            $rules = array_merge($rules, [
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'title:en' =>'required',
                'short_description:en' =>'required',
            ]);
        } else {
            $rules = array_merge($rules, [
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
                'title:en' =>'required',
                'short_description:en' =>'required',
            ]);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title:en.required'  => 'English field title must be required',
            'short_description:en.required'  => 'English field Short Descrition must be required',
            'image'=> 'Image Type Invalid',
        ];
    }
}
