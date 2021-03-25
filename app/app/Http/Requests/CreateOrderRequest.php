<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'user_name' => 'required',
            'order_details.*.item_id' => 'required',
            'order_details.*.quantity' => 'required|numeric',
            'order_details.*.price' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }

    public function messages() {
        return [
            'order_details.*.item_id.required' => 'Please select the item.',
            'order_details.*.quantity.required' => 'Please enter the quantity.',
            'order_details.*.quantity.numeric' => 'Please enter the numeric quantity.',
            'order_details.*.price.required' => 'Please enter the price.',
            'order_details.*.price.regex' => 'Please enter the price in valid format.',
        ];
    }
}
