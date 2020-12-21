<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(){
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        $rules = [ 'first_name' => 'required|string','last_name' => 'required|string' ];
        if($this->method(true) === "POST"){
            $rules = array_merge($rules,[
                'email'         => 'required|string|email|max:255|unique:users,email',
                'password'      => 'required|string|min:8|confirmed',
            ]);
        }else{
            $id = $this->segment(3);
            $rules = array_merge($rules,[
                'email'      => 'required|string|max:255|unique:users,email,'.$id,
            ]);
        }
        return $rules;
    }

    public function messages()
    {
        return [

        ];
    }
}
