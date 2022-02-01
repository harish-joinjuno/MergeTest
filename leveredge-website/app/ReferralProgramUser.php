<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int                              $id
 * @property int                              $referral_program_id
 * @property int                              $user_id
 * @property Carbon                           $starts_on
 * @property Carbon                           $ends_before
 * @property User                             $user
 * @property ReferralProgram                  $referralProgram
 * @property Carbon                           $created_at
 * @property Carbon                           $updated_at
 * @property Collection|ReferralRewardClaim[] $referralRewardClaims
 */
class ReferralProgramUser extends Model
{
    protected $fillable = [
        'referral_program_id',
        'user_id',
        'starts_on',
        'ends_before',
    ];

    protected $casts = [
        'starts_on'   => 'date',
        'ends_before' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referralProgram()
    {
        return $this->belongsTo(ReferralProgram::class);
    }

    public function referralRewardClaims()
    {
        return $this->hasMany(ReferralRewardClaim::class);
    }

    protected function getReferredUsersQuery()
    {
        $query = User::query()
            ->where('referred_by_id', $this->user->id)
            ->where('created_at', '>=', $this->starts_on);
        if ($this->ends_before) {
            $query->where('created_at', '<', $this->ends_before);
        }

        return $query;
    }

    public function referredUsers()
    {
        return $this->getReferredUsersQuery()->get();
    }

    public function isCurrentReferralProgram()
    {
        $today = Carbon::today();
        if ($this->ends_before) {
            $condition_1 = $today->lessThan($this->ends_before);
        } else {
            $condition_1 = true;
        }
        $condition_2 = $today->greaterThanOrEqualTo($this->starts_on);

        return $condition_1 && $condition_2;
    }

    public function getReferralsCount()
    {
        return $this->getReferredUsersQuery()->count();
    }

    public function getPendingAmount()
    {
        $query = $this->user
            ->referredUsers()
            ->where('created_at', '>=', $this->starts_on)
            ->whereNotExists(function (Builder $query) {
                $query->select(DB::raw(1))
                    ->from('access_the_deals')
                    ->whereRaw('users.id = access_the_deals.user_id')
                    ->where('loan_status_id', '=', DealStatus::SIGNED_THE_LOAN);
            });

        if ($this->ends_before) {
            $query->where('created_at', '<', $this->ends_before);
        }

        $count = $query->count();

        if (ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_SCHOLARSHIP_POT == $this->referralProgram->slug) {
            return $count * 25;
        }

        if (ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES == $this->referralProgram->slug) {
            return $count * 25;
        }

        if (ReferralProgram::REFERRAL_PROGRAM_TWO_HUNDRED_PER_LOAN_ABOVE_20K == $this->referralProgram->slug) {
            return $count * 200;
        }

        return 0;
    }

    public function getSuccessfulReferralsCount()
    {
        $query = $this->user
            ->referredUsers()
            ->where('created_at', '>=', $this->starts_on)
            ->whereExists(function (Builder $query) {
                $query = $query->select(DB::raw(1))
                    ->from('access_the_deals')
                    ->whereRaw('users.id = access_the_deals.user_id')
                    ->where('loan_status_id', '=', DealStatus::SIGNED_THE_LOAN);

                if (ReferralProgram::REFERRAL_PROGRAM_TWO_HUNDRED_PER_LOAN_ABOVE_20K == $this->referralProgram->slug) {
                    $query->where('loan_amount','>=',20000);
                }

            });

        if ($this->ends_before) {
            $query->where('created_at', '<', $this->ends_before);
        }

        return $query->count();
    }

    public function getEarnedAmount()
    {
        if (ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_SCHOLARSHIP_POT == $this->referralProgram->slug) {
            return $this->getSuccessfulReferralsCount() * 25;
        }

        if (ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES == $this->referralProgram->slug) {
            return $this->getSuccessfulReferralsCount() * 25;
        }

        if (ReferralProgram::REFERRAL_PROGRAM_QUARTER_PERCENT_OF_FIRST_LOAN === $this->referralProgram->slug ) {
            $earnedAmount = 0;
            foreach ($this->referredUsers() as $referredUser) {
                $firstSignedDeal = AccessTheDeal::where('user_id',$referredUser->id)
                    ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
                    ->orderBy('created_at','asc')
                    ->first();

                if ($firstSignedDeal && $firstSignedDeal->loan_amount) {
                    $earnedAmount += $firstSignedDeal->loan_amount*0.25/100;
                }
            }

            return $earnedAmount;
        }

        if (ReferralProgram::REFERRAL_PROGRAM_TWO_HUNDRED_PER_LOAN_ABOVE_20K == $this->referralProgram->slug) {
            return $this->getSuccessfulReferralsCount() * 200;
        }

        return abort(500);
    }

    public function getPaidAmount()
    {
        switch ($this->referralProgram->slug) {
            case ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_SCHOLARSHIP_POT:
            case ReferralProgram::REFERRAL_PROGRAM_QUARTER_PERCENT_OF_FIRST_LOAN:
            case ReferralProgram::REFERRAL_PROGRAM_TWO_HUNDRED_PER_LOAN_ABOVE_20K:
                return $this->referralRewardClaims()->sum('value');

            case ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES:
                return $this->referralRewardClaims()->where('reward', 'LIKE', '%For Referrals%')->sum('value');
        }

        return abort(500);
    }

    public function getAmountToBePaid()
    {
        return $this->getEarnedAmount() - $this->getPaidAmount();
    }
}
