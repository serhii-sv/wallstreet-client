<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Requests;

use App\Rules\RuleEnoughBalance;
use App\Rules\RuleUUIDEqual;
use App\Rules\RuleWalletExist;
use App\Rules\RuleWalletWithExternalAddress;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RequestWithdraw
 * @package App\Http\Requests
 *
 * @property string wallet_id
 * @property float amount
 */
class RequestWithdraw extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \return true;;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wallet_id' => ['required', new RuleWalletExist, new RuleUUIDEqual, new RuleWalletWithExternalAddress],
            'amount'    => ['numeric', new RuleEnoughBalance, 'min:0.0003', 'max:1000000'],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'wallet_id.required' => __('Wallet is required'),
            'amount.numeric'     => __('Amount have to be numeric'),
        ];
    }
}
