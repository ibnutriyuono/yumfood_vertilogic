<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vendor_id' => 'required',
            'dish_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'vendor_id.required' => 'Vendor Id field is required!',
            'dish_id.required' => 'Dish Id field is required!',
            'user_id.required' => 'User Id field is required!',
            'quantity.required' => 'Quantity field is required!',
        ];
    }
}
