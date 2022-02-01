<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $referral_code
 * @property int    $partner_type
 * @property int    $contract_type
 */
class PartnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required',
            'referral_code' => 'required|unique:users,referral_code|size:8',
            'partner_type'  => 'required|integer|exists:partner_types,id',
            'contract_type' => 'required|integer|exists:contract_types,id',
        ];
    }
}
