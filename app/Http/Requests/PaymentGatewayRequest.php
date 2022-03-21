<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentGatewayRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'credit_card_number' => 'required|int',
            'credit_card_name' => 'required|string',
            'cvv' => 'required|int',
            'date' => 'required|date',
            'amount' => 'required|int',
        ];
    }
}
