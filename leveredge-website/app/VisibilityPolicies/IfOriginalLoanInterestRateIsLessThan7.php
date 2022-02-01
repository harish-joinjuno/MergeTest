<?php


namespace App\VisibilityPolicies;

use App\Contracts\VisibilityPolicyInterface;

class IfOriginalLoanInterestRateIsLessThan7 implements VisibilityPolicyInterface
{
    public function getDefinition()
    {
        return [
            'method'               => 'is-less-based-on-value-of-input-on-page',
            'field_name'           => 'original_loan_interest_rate',
            'visible_value'       => 7,
            'hidden_values'        => null,
            'default_visibility'   => false,
        ];
    }
}
