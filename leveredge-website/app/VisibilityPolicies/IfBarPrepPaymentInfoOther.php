<?php


namespace App\VisibilityPolicies;


class IfBarPrepPaymentInfoOther implements \App\Contracts\VisibilityPolicyInterface
{

    public function getDefinition()
    {
        $visibleBarPrepPaymentInfoResponses = [
            'Other',
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'bar_prep_payment_info',
            'visible_values'      => $visibleBarPrepPaymentInfoResponses,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
