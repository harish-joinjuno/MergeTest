<?php

namespace App\Http\Requests;

use App\LeveredgeRewardClaim;
use App\PaymentMethod;
use App\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RewardClaimRequest extends FormRequest
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
            'deal_id' => [
                'required',
                'exists:deals,id',
            ],
            'loan_amount'                 => 'required|numeric',
            'payment_method_id'           => [
                'required',
                'exists:payment_methods,id',
            ],
            'fileId'                 => 'required|numeric|min:1',
            'credit_score'           => 'required',
            'annual_income'          => 'required',
            'cosigner_credit_score'  => 'required',
            'cosigner_annual_income' => 'nullable|numeric',
        ];
    }
}
