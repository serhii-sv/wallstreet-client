<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Requests;

use App\Rules\RuleLoginIsCorrect;
use App\Rules\RulePartnerIdExists;
use App\Rules\RulePhoneIsCorrect;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

/**
 * Class RequestSaveUserSettings
 * @package App\Http\Requests
 *
 * @property string email
 * @property integer partner_id
 * @property string phone
 * @property string skype
 * @property string login
 * @property string name
 */
class RequestSaveUserSettings extends FormRequest
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
            'email'      => 'email',
            'partner_id' => !empty(Input::get('partner_id')) ? ['numeric', new RulePartnerIdExists] : '',
            'phone'      => !empty(Input::get('phone')) ? [new RulePhoneIsCorrect()] : '',
            'skype'      => '',
            'login'      => !empty(Input::get('login')) ? [new RuleLoginIsCorrect()] : '',
            'name'       => '',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.email'        => __('Wrong email format.'),
            'partner_id.numeric' => __('Partner ID have to be numeric.'),
        ];
    }
}
