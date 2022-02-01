<?php


namespace App\VisibilityPolicies;


use App\UserProfile;

class IfCosignerStatusIsYes implements \App\Contracts\VisibilityPolicyInterface
{

    public function getDefinition()
    {
        $visibleCosignerStatus = [
            UserProfile::COSIGNER_STATUS_YES,
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'cosigner_status',
            'visible_values'      => $visibleCosignerStatus,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
