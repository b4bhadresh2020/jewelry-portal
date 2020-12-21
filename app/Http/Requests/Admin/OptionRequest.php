<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [ 
            'attribute_id'   => 'required',
            'name:en'       => 'required',
        ];
    }

    public function messages(){
        return [
            'attribute_id.required'  => 'Attribute field required',
            'name:en.required'      => 'English field name must be required',
        ];
    }
}
