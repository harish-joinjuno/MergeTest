<?php


namespace App\VisibilityPolicies;

use App\UserProfile;
use phpDocumentor\Reflection\Types\Collection;

class IfCitizenshipIsInternational implements \App\Contracts\VisibilityPolicyInterface
{
    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function getDefinition()
    {
        $visibleImmigrationStatuses = [
            UserProfile::IMMIGRATION_STATUS_OTHER,
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'immigration_status',
            'visible_values'      => $visibleImmigrationStatuses,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
