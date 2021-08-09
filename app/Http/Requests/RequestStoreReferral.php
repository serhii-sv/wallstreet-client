<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RequestStoreReferral
 * @package App\Http\Requests
 *
 * @property integer level
 * @property float percent
 */
class RequestStoreReferral extends FormRequest
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
            'level'   => 'bail|required|integer|unique:referrals|min:0',
            'percent' => 'numeric|min:0',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'level.required'  => __('Level is required.'),
            'level.integer'   => __('Level have to be numeric.'),
            'level.unique'    => __('Level have to be unique.'),
            'level.min'       => __('Minimum level is 0.'),

            'percent.numeric' => __('Percent have to be numeric.'),
            'percent.min'     => __('Minimum percent is 0.'),
        ];
    }
}
