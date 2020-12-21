<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class BannerRequest extends FormRequest
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
        $rules = [];
        if ($this->method(true) === "POST") {
            $rules = array_merge($rules, [
                'banner'            => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'mobile_banner'     => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'title:en'          => 'required',
                'description:en'    => 'required',
                // 'link_text:en'   => 'required',
                // 'link_url'       => 'required',
            ]);
        } else {
            $rules = array_merge($rules, [
                'banner'            => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
                'mobile_banner'     => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
                'title:en'          => 'required',
                'description:en'    => 'required',
                // 'link_text:en'   => 'required',
                // 'link_url'       => 'required',
            ]);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title:en.required'                 => 'English field title must be required',
            'description:en.required'           => 'English field description must be required',
            'link_text:en.required'             => 'English field Link Text must be required',
            'link_url.required'                 => 'English field Link Url must be required',
            'banner.mimes.required'             => 'Image Type Invalid',
            'mobile_banner.mimes.required'      => 'Image Type Invalid',
        ];
    }
}
