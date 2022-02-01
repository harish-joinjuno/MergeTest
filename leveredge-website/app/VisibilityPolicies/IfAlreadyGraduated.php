<?php


namespace App\VisibilityPolicies;


use App\Contracts\VisibilityPolicyInterface;
use App\UserProfile;

class IfAlreadyGraduated implements VisibilityPolicyInterface
{

    public function getDefinition()
    {
        return [
            'method'              => 'based-on-value-of-callable-multiple-inputs-on-page',
            'inputs'              => [
                [
                    'field_name'          => 'graduate_month_year',
                    'hidden_values'       => null,
                    'default_visibility'  => false,
                    'callable'            => 'isSameOrBefore',
                ],
                [
                    'field_name'          => 'undergraduate_month_year',
                    'hidden_values'       => null,
                    'default_visibility'  => false,
                    'callable'            => 'isSameOrBefore',
                ],
            ],
        ];
    }
}
