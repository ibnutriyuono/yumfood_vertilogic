<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
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
            'name' => 'required',
            'vendor_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required!',
            'vendor_id.required' => 'Vendor Id field is required!'
        ];
    }
}
