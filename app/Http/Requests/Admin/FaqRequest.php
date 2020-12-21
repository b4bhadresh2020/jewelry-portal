<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FaqRequest extends FormRequest
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
            'faq_category_id'   => 'required',
            'question:en'       => 'required',
            'answer:en'       => 'required',
        ];
          
            return $rules;
    }
    public function messages(){
        return [
            'faq_category_id.required'  => 'FaqCategory field required',
            'question:en.required'      => 'English field question must be required',
            'answer:en.required'      => 'English field answer must be required',
        ];
    }
}
