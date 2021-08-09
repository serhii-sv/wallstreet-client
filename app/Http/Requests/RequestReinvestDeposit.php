<?php

namespace App\Http\Requests;

use App\Rules\RuleCheckRate;
use App\Rules\RulePlanRange;
use App\Rules\RuleRateCurrency;
use App\Rules\RuleUUIDEqual;
use Illuminate\Foundation\Http\FormRequest;

class RequestReinvestDeposit extends FormRequest
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
            'amount'    => ['required', 'numeric', 'min:0.00000001']
        ];
    }
    
    public function messages()
    {
        return [
            'amount.numeric'     => __('Amount have to be numeric'),
        ];
    }
}
