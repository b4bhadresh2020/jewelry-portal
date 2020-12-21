<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
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
        $rules = ['name:en' => 'required', 'description:en' => 'required'];
        if ($this->method(true) === "POST") {
            if ($this->request->get('offer_banner_visibility') == 1) {
                $rules = array_merge($rules, [
                    'offer_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                ]);
            }
            $rules = array_merge($rules, [
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'banner_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ]);
        } else {
            $rules = array_merge($rules, [
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
                'banner_image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
                'offer_image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
            ]);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name:en.required'  => 'English field name must be required',
            'description:en.required'  => 'English field description must be required',
            'image.mimes'       => 'Image Type Invalid',
            'banner_image.mimes'       => 'Banner Image Type Invalid',
            'offer_image.mimes'       => 'Offer Image Type Invalid'
        ];
    }
}
