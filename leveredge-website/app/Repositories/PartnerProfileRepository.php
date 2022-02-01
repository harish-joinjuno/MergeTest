<?php


namespace App\Repositories;

use App\PartnerProfile;
use App\Repositories\Contracts\PartnerProfileRepositoryInterface;

class PartnerProfileRepository extends Repository implements PartnerProfileRepositoryInterface
{
    protected $model = PartnerProfile::class;

    public function createForUser($userId, $partnerTypeId, $contractTypeId): object
    {
        return $this->store([
            'user_id'          => $userId,
            'partner_type_id'  => $partnerTypeId,
            'contract_type_id' => $contractTypeId,
        ]);
    }
}
