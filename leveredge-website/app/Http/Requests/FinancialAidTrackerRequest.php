<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FinancialAidTrackerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $defaultRules = [
            'reports.*.university_id'     => 'required|exists:universities,id',
            'reports.*.degree_id'         => 'required|exists:degrees,id',
            'reports.*.aid_qualification' => 'required|in:merit-based,need-based,both',
            'reports.*.aid_amount'        => 'required|numeric',
            'email'                       => 'email|nullable',
            'graduation_year'             => 'numeric',
            'taken_test'                  => 'required|in:gmat,gre,no_test',
        ];

        if ($this->request->get('taken_test') === 'gre') {
            $defaultRules['gre_score'] = 'required|numeric|between:200,360';
        }
        if ($this->request->get('taken_test') === 'gmat') {
            $defaultRules['gmat_score'] = 'required|numeric|between:200,800';
        }

        foreach ($this->request->get('reports') as $report) {
            if ($report['aid_qualification'] !== 'merit-based') {
                $defaultRules = array_merge($defaultRules, [
                    'income_3'        => 'numeric',
                    'income_2'        => 'numeric',
                    'income_1'        => 'numeric',
                    'current_income'  => 'numeric',
                    'liquid_assets'   => 'numeric',
                    'illiquid_assets' => 'numeric',
                    'liabilities'     => 'numeric',
                    'total_mortgage'  => 'numeric',
                ]);
            }
            break;
        }


        return $defaultRules;
    }
}
