<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DiscountRequest extends FormRequest
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

        if ($this->method(true) === "POST" ||  $this->method(true) === "PUT") {
            $rules = ['applicable_type' => 'required', 'discount_type' => 'required', 'amount_type' => 'required', 'from_date' => 'required', 'to_date' => 'required', 'amount' => 'required|numeric', 'redeem_limit' => 'required'];
            $discount_type = $this->request->get('discount_type');
            if ($discount_type == 1) {
                $rules = array_merge($rules, [
                    'coupon_code' => 'required|max:6',
                ]);
            } else {
                $rules = array_merge($rules, [
                    'title:en' => 'required',
                    'description:en' => 'required'
                ]);
            }

            $applicable_type = $this->request->get('applicable_type');
            if ($applicable_type == "category") {
                $rules = array_merge($rules, [
                    'multiple_category_id' => 'required',
                ]);
            } else  if ($applicable_type == "subcategory") {
                $rules = array_merge($rules, [
                    'category_id' => 'required',
                    'subcategory_id' => 'required',
                ]);
            } else  if ($applicable_type == "subcategory") {
                $rules = array_merge($rules, [
                    'multiple_category_id' => 'required',
                ]);
            } else  if ($applicable_type == "user") {
                $rules = array_merge($rules, [
                    'user_id' => 'required',
                ]);
            } else  if ($applicable_type == "product") {
                $rules = array_merge($rules, [
                    'product_id' => 'required',
                ]);
            }
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title:en.required'  => 'English field name must be required',
            'description:en.required'  => 'Description field name must be required',
            'applicable_type.required' => "Apply for type filed must be required",
            'multiple_category_id.required' => "Category filed name must be required",
            'category_id.required' => "Category filed name must be required",
            'subcategory_id.required' => "Subcategory filed name must be required",
            'user_id.required' => "User filed name must be required",
            'product_id.required' => "Product filed name must be required",
            'amount.required' => "Discount filed name must be required",
            'amount.numeric' => "The discount must be a number"
        ];
    }
}