<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RequestTopup
 * @package App\Http\Requests
 *
 * @property string currency
 * @property float amount
 * @property string captcha
 */
class RequestTopup extends FormRequest
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
            'payment_system' => 'required|uuid',
            'currency' => 'uuid',
            'amount'   => 'required|regex:/^\d*(\.\d{1,8})?$/|min:0.00000001',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'currency.required' => __('Currency is required.'),
            'currency.max'      => __('Currency maximum string length is 255 symbols.'),
            'currency.string'   => __('Currency have to be string.'),

            'amount.required'   => __('Amount is required.'),
            'amount.regex'      => __('Wrong amount format.'),
            'amount.min'        => __('Minimum amount is').' 0.00000001',
        ];
    }
}
