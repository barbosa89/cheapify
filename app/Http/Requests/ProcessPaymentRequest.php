<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Constants\PaymentGateways;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Http\FormRequest;

class ProcessPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Cart::count() > 0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100', 'min:3'],
            'document' => ['required', 'numeric', 'digits_between:6,25'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string', 'max:256', 'min:10'],
            'gateway' => ['required', 'alpha', 'max:40', Rule::in((new PaymentGateways())->toArray())]
        ];
    }
}
