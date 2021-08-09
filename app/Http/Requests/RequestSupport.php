<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RequestSupport
 * @package App\Http\Requests
 *
 * @property string email
 * @property string text
 */
class RequestSupport extends FormRequest
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
            'email'   => 'required|max:255|email',
            'text'    => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'   => trans('main.emails.request.email_required'),
            'email.max'        => trans('main.emails.request.email_max'),
            'email.email'      => trans('main.emails.request.email_email'),

            'text.required'    => trans('main.emails.request.text_required'),
            'text.min'         => trans('main.emails.request.text_min'),
        ];
    }
}
