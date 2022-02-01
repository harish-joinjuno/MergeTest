<?php


namespace App\Repositories\Contracts;


interface PartnerProfileRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $userId
     * @param $partnerTypeId
     * @param $contractTypeId
     *
     * @return mixed
     */
    public function createForUser($userId, $partnerTypeId, $contractTypeId);
}
