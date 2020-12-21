<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductImageRequest extends FormRequest
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
        if($this->method(true) === "POST"){
            foreach (request('sku') as $key => $value) {
                $rules[$value] = [
                    'default_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000|array',
                ];
            }
        }else{
            $rules = [
                'default_image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000',
            ];
        }
        return $rules;
    }
}
