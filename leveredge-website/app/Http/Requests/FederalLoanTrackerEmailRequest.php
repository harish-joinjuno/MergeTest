<?php

namespace App\Http\Requests;

use App\FederalLoanTrackerEmail;
use Illuminate\Foundation\Http\FormRequest;

class FederalLoanTrackerEmailRequest extends FormRequest
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
            'email'  => 'required|email|unique:federal_loan_tracker_emails',
        ];
    }

    public function persist()
    {
        $trackerEmail            = new FederalLoanTrackerEmail();
        $trackerEmail->email     = $this->request->get('email');
        $trackerEmail->client_id = getClientId();
        $trackerEmail->save();
    }
}
