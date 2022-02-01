<?php


namespace App\Repositories\Contracts;


interface ReferralProgramUserRepositoryInterface extends RepositoryInterface
{
    public function createForUser(int $userId, int $referralProgramId);

    public function createQuarterPercentOfFirstLoan(int $userId);
}
