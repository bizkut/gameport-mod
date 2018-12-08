<?php

namespace App\Http\Requests\Frontend\User;

use App\Http\Requests\Request;

/**
 * Class UpdateBankaccountRequest
 * @package App\Http\Requests\Frontend\User
 */
class UpdateBankaccountRequest extends Request
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
            'firstname'  => 'required',
            'lastname'  => 'required',
            'iban'  => 'required',
            'swiftcode'  => 'required',
            'bankname'  => 'required',
            'bankaddress'  => 'required',
        ];
    }
}