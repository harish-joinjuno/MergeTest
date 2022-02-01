<?php


namespace App\Repositories;

use App\ReferralProgram;
use App\ReferralProgramUser;
use App\Repositories\Contracts\ReferralProgramRepositoryInterface;
use App\Repositories\Contracts\ReferralProgramUserRepositoryInterface;

class ReferralProgramUserRepository extends Repository implements ReferralProgramUserRepositoryInterface
{
    protected $model = ReferralProgramUser::class;

    public function createForUser(int $userId, int $referralProgramId): object
    {
        return $this->store([
            'user_id'             => $userId,
            'referral_program_id' => $referralProgramId,
        ]);
    }

    public function createQuarterPercentOfFirstLoan(int $userId): object
    {
        return $this->createForUser(
            $userId,
            resolve(ReferralProgramRepositoryInterface::class)->findBySlug(ReferralProgram::REFERRAL_PROGRAM_QUARTER_PERCENT_OF_FIRST_LOAN)->id);
    }
}
