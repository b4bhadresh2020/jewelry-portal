<?php

namespace App\Http\Requests\Admin\Product;

use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Step1Request extends FormRequest
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
        $this->slug = str_replace(" ", "-", strtolower(request('title:en')));
        $rules = [
            'title:en'   => 'required|unique:products,slug,'.$this->slug,
        ];
        return $rules;
    }

    public function messages(){
        return [
            'title:en.required' => 'English field title must be required',
        ];
    }
}
