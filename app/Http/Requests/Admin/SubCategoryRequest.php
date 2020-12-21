<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubCategoryRequest extends FormRequest
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
            'category_id'   => 'required',
            'name:en'       => 'required',
        ];
        if($this->method(true) === "POST"){
            $rules = array_merge($rules,[
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            ]);
        }else{
            $rules = array_merge($rules,[
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
            ]);
        }
        return $rules;
    }

    public function messages(){
        return [
            'category_id.required'  => 'Category field required',
            'name:en.required'      => 'English field name must be required',
            'image.mimes'           => 'Image Type Invalid',
        ];
    }
}
