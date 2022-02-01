<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @property int                             $id
 * @property string                          $first_name
 * @property string                          $last_name
 * @property string                          $name
 * @property string                          $email
 * @property Carbon                          $email_verified_at
 * @property string                          $password
 * @property string                          $remember_token
 * @property string                          $refresh_token
 * @property int                             $referred_by_id
 * @property string                          $referral_code
 * @property Carbon                          $created_at
 * @property Carbon                          $updated_at
 * @property string                          $referral_link
 * @property UserProfile                     $profile
 * @property PartnerProfile                  $partnerProfile
 * @property User                            $referredBy
 * @property Collection|Role[]               $roles
 * @property Collection|User[]               $referredUsers
 * @property Collection|NegotiationGroupUser $negotiationGroupUsers
 * @property Collection|ReferralProgramUser  $referralProgramUsers
 * @property Collection|AccessTheDeal        $accessTheDeals
 * @property Collection|LeveredgeRewardClaim[] $rewardClaims
 * @property-read Collection|NegotiationGroupUserExclusion $negotiationGroupUserExclusions
 * @property-read AccessTheDeal $firstLoanDealAccessed
 * @property-read AccessTheDeal $firstInsuranceDealAccessed
 * @property-read Collection|UserClient[] $userClients
 * @property-read DeleteRequest $deleteRequest
 */
class User extends Authenticatable
{
    use Notifiable,
        SoftDeletes;

    const USER_LIMIT_PAID_AMOUNT_PER_WEEK     = 2000;
    const USER_LIMIT_RECEIVED_AMOUNT_PER_WEEK = 150;

    const SOCIALLY_POWERED_EMAIL = 'sociallypowered@joijuno.com';

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailQueued);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'referral_code',
        'first_name',
        'last_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canImpersonate()
    {
        $emails = [
            'nikhil@leveredge.org',
            'max@leveredge.org',
            'helene@leveredge.org',
            'nicolas@leveredge.org',
        ];

        return in_array($this->email, $emails);
    }

    public function canBeImpersonated()
    {
        $exclusionList = [
            'nikhil@leveredge.org',
        ];

        if (in_array($this->email, $exclusionList)) {
            return false;
        }

        if ($this->hasAnyRole(['lender','admin','nova-user'])) {
            return false;
        }

        return true;
    }

    protected static function booted()
    {
        static::saving(function ($user) {
            if (strlen($user->name) > 255) {
                $user->name = substr($user->name, 0, 255);
            }

            if (strlen($user->first_name) > 128) {
                $user->first_name = substr($user->first_name, 0, 128);
            }

            if (strlen($user->last_name) > 128) {
                $user->last_name = substr($user->last_name, 0, 128);
            }

            if (strlen($user->first_name . $user->last_name) > strlen($user->name)) {
                $user->name = substr($user->first_name . ' ' . $user->last_name, 0, 255);
            }

            if (strlen($user->name) > strlen($user->first_name . $user->last_name)) {
                $names = explode(' ', $user->name);
                $user->first_name = substr(array_shift($names), 0, 128);
                $user->last_name = substr(implode(' ', $names), 0, 128);
            }
        });
    }

    public function heardFromOption()
    {
        return $this->belongsTo(HeardFromOption::class);
    }

    public function getPrimaryRoleAttribute()
    {
        return $this->roles->first();
    }

    public function getReferralLinkAttribute()
    {
        return url('/?grow=' . $this->referral_code);
    }

    public function getInsuranceReferralLinkAttribute()
    {
        return url('/insurance/international-health/?grow=' . $this->referral_code);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->orderBy('priority', 'asc');
    }

    public function ambassadors()
    {
        return $this->partnerProfile()
            ->whereContractTypeId(ContractType::TYPE_CAMPUS_AMBASSADOR_ID)
            ->wherePartnerTypeId(PartnerType::TYPE_CAMPUS_AMBASSADOR_ID);
    }

    //TODO: Should display this result only until March 5th (included)
    public function getTopAmbassadors()
    {
        $ambassadors = self::whereHas('ambassadors')->pluck('name', 'id')->toArray();
        $users       = self::whereIn('referred_by_id', array_keys($ambassadors))
            ->whereHas('profile', function ($query) {
                $query->where('signup_progress', 'completed');
            })->get();

        return $users->groupBy('referred_by_id')
            ->sortByDesc(function ($referrals) {
                return $referrals->count();
            })
            ->take(5)
            ->map(function ($referrals, $key) use ($ambassadors) {
                return [
                    'name'      => $ambassadors[$key],
                    'referrals' => $referrals->count(),
                ];
            })->toArray();
    }

    /**
     * @param string|array $roles
     *
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
            abort(401, 'This action is unauthorized.');
        }

        return $this->hasRole($roles) ||
        abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles.
     *
     * @param array $roles
     *
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role.
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function affiliateData()
    {
        return $this->hasOne('App\Affiliate', 'email', 'email');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    /** @deprecated */
    public function partner_profile()
    {
        return $this->hasOne(PartnerProfile::class);
    }

    public function partnerProfile()
    {
        return $this->hasOne(PartnerProfile::class);
    }

    public function hasNegotiationGroupUsers(): bool
    {
        return ($this->negotiationGroupUsers->count() > 0);
    }

    /*
     * Get the User Who Referred This User
     */
    public function referredBy()
    {
        return $this->belongsTo(\App\User::class, 'referred_by_id');
    }

    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referred_by_id');
    }

    /*
     * User is Eligible for Cash for Being Referred if he was referred by someone and has not filed a claim yet
     */
    public function getIsEligibleForCashForBeingReferredAttribute()
    {
        return $this->referredBy()->exists()
            && !$this->referralRewardClaims()
                ->where('reward', 'LIKE', '%For Being Referred%')
                ->exists()
            && $this->accessTheDeals()
                ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
                ->exists();
    }

    /*
     * Check if User is Eligible for a T-Shirt through the Rewards Program
     */
    public function getIsEligibleForShirtAttribute()
    {
        $has_sufficient_referrals = $this->hasSufficientReferralsForShirt;
        $has_claimed_reward       = $this->referralRewardClaims()->where('reward', 'LIKE', '%shirt%')->exists();

        if ($has_sufficient_referrals && !$has_claimed_reward) {
            return true;
        }

        return false;
    }

    /*
     * Check if User is Eligible for Back Pack through the Rewards Program
     */
    public function getIsEligibleForBackPackAttribute()
    {
        $has_sufficient_referrals = ($this->hasSufficientReferralsForBackPack);
        $has_claimed_reward       = $this->referralRewardClaims()->where('reward', 'LIKE', '%backpack%')->exists();

        if ($has_sufficient_referrals && !$has_claimed_reward) {
            return true;
        }

        return false;
    }

    /*
     * Check if User is Eligible for Air Pods through the Rewards Program
     */
    public function getIsEligibleForAirPodsAttribute()
    {
        $has_sufficient_referrals = ($this->hasSufficientReferralsForAirPods);
        $has_claimed_reward       = $this->referralRewardClaims()->where('reward', 'LIKE', '%headphone%')->exists();

        if ($has_sufficient_referrals && !$has_claimed_reward) {
            return true;
        }

        return false;
    }

    /*
     * Check if User is Eligible for Apple Watch through the Rewards Program
     */
    public function getIsEligibleForAppleWatchAttribute()
    {
        $has_sufficient_referrals = ($this->hasSufficientReferralsForAppleWatch);
        $has_claimed_reward       = $this->referralRewardClaims()->where('reward', 'LIKE', '%smart watch%')->exists();

        if ($has_sufficient_referrals && !$has_claimed_reward) {
            return true;
        }

        return false;
    }

    /*
     * Check if User is Eligible for $3000 through the Rewards Program
     */
    public function getIsEligibleForThreeThousandCashRewardAttribute()
    {
        $has_sufficient_referrals = ($this->hasSufficientReferralsForThreeThousandCashReward);
        $has_claimed_reward       = $this->referralRewardClaims()->where('reward', 'LIKE', '%$3k%')->exists();

        if ($has_sufficient_referrals && !$has_claimed_reward) {
            return true;
        }

        return false;
    }

    /*
     * Check if User is Eligible for $10,000 through the Rewards Program
     */
    public function getIsEligibleForTenThousandCashRewardAttribute()
    {
        $has_sufficient_referrals = ($this->hasSufficientReferralsForTenThousandCashReward);
        $has_claimed_reward       = $this->referralRewardClaims()->where('reward', 'LIKE', '%$10k%')->exists();

        if ($has_sufficient_referrals && !$has_claimed_reward) {
            return true;
        }

        return false;
    }

    /*
     * Check if User is Eligible for 1 Year Tuition through the Rewards Program
     */
    public function getIsEligibleForOneYearTuitionRewardAttribute()
    {
        $has_sufficient_referrals = ($this->hasSufficientReferralsForOneYearTuitionReward);
        $has_claimed_reward       = $this->referralRewardClaims()->where('reward', 'LIKE', '%tuition%')->exists();

        if ($has_sufficient_referrals && !$has_claimed_reward) {
            return true;
        }

        return false;
    }

    /*
     * Check if User is Eligible for a T-Shirt through the Rewards Program
     */
    public function getHasSufficientReferralsForShirtAttribute()
    {
        return $this->currentReferralProgramUser()->getSuccessfulReferralsCount() >= 1;
    }

    /*
     * Check if User is Eligible for Back Pack through the Rewards Program
     */
    public function getHasSufficientReferralsForBackPackAttribute()
    {
        return $this->currentReferralProgramUser()->getSuccessfulReferralsCount() >= 5;
    }

    /*
     * Check if User is Eligible for Air Pods through the Rewards Program
     */
    public function getHasSufficientReferralsForAirPodsAttribute()
    {
        return $this->currentReferralProgramUser()->getSuccessfulReferralsCount() >= 10;
    }

    /*
     * Check if User is Eligible for Apple Watch through the Rewards Program
     */
    public function getHasSufficientReferralsForAppleWatchAttribute()
    {
        return $this->currentReferralProgramUser()->getSuccessfulReferralsCount() >= 25;
    }

    /*
     * Check if User is Eligible for $3000 through the Rewards Program
     */
    public function getHasSufficientReferralsForThreeThousandCashRewardAttribute()
    {
        return $this->currentReferralProgramUser()->getSuccessfulReferralsCount() >= 50;
    }

    /*
     * Check if User is Eligible for $10,000 through the Rewards Program
     */
    public function getHasSufficientReferralsForTenThousandCashRewardAttribute()
    {
        return $this->currentReferralProgramUser()->getSuccessfulReferralsCount() >= 100;
    }

    /*
     * Check if User is Eligible for 1 Year Tuition through the Rewards Program
     */
    public function getHasSufficientReferralsForOneYearTuitionRewardAttribute()
    {
        return $this->currentReferralProgramUser()->getSuccessfulReferralsCount() >= 500;
    }

    /*
     * Get the Referral Reward Claims Filed by this User
     */
    public function referralRewardClaims()
    {
        return $this->hasMany(\App\ReferralRewardClaim::class, 'user_id');
    }

    // TODO: Odd Definition of the relationship. Is this right?
    public function negotiationGroupUsers()
    {
        $relation = $this->hasMany(NegotiationGroupUser::class);

        $relation
            ->select('negotiation_group_users.*')
            ->join('academic_years', 'academic_years.id', '=', 'negotiation_group_users.academic_year_id')
            ->orderBy('academic_years.display_priority')
            ->orderBy('academic_years.refinance')
            ->orderBy('academic_years.starts_on');

        return $relation;
    }

    public function negotiationGroupUserExclusions()
    {
        return $this->hasMany(NegotiationGroupUserExclusion::class);
    }

    /** @deprecated */
    public function completedCampusAmbassadorTasks()
    {
        return $this->belongsToMany(\App\CampusAmbassadorTask::class)
            ->withPivot([
                'id',
                'amount',
                'ambassador_notes',
                'admin_notes',
                'payment_completed',
            ])
            ->withTimestamps();
    }

    public function referralProgramUsers()
    {
        return $this->hasMany(ReferralProgramUser::class);
    }

    public function currentReferralProgramUser()
    {
        /** @var ReferralProgramUser $referralProgramUser */
        foreach ($this->referralProgramUsers as $referralProgramUser) {
            if ($referralProgramUser->isCurrentReferralProgram()) {
                return $referralProgramUser;
            }
        }

        return null;
    }

    public function currentNegotiationGroupUser()
    {
        /* @var NegotiationGroupUser $negotiationGroupUser */
        return $this->negotiationGroupUsers()->first();
    }

    public function referralStatus()
    {
        $status = 'Signed Up';

        if (UserProfile::SIGNUP_PROGRESS_COMPLETED == $this->profile->signup_progress) {
            $status = 'Profile Complete';
        }

        if (AccessTheDeal::where('user_id', $this->id)->where('loan_status_id', DealStatus::SIGNED_THE_LOAN)->exists()) {
            $status = 'Borrowed';
        }

        return $status;
    }

    public function paidPayments()
    {
        return $this->hasMany(Payment::class, 'payer_id');
    }

    public function receivedPayments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function amountPaidThisWeek(): int
    {
        $start = now()->startOfWeek();
        $end   = now()->endOfWeek();

        $sum = $this->paidPayments()
            ->whereBetween('created_at', [$start, $end])
            ->sum('amount');

        return $sum ?? 0;
    }

    public function amountReceivedThisWeek(): int
    {
        $start = now()->startOfWeek();
        $end   = now()->endOfWeek();

        $sum = $this->receivedPayments()
            ->whereBetween('created_at', [$start, $end])
            ->sum('amount');

        return $sum ?? 0;
    }

    public function messages()
    {
        return $this->hasMany(SmsMessage::class);
    }

    public function novaPermissions()
    {
        return $this->hasMany(NovaResourcePermission::class, 'user_id');
    }

    public function canViewAny($resource)
    {
        return app('user_is_admin')
            ||
        app('nova_permissions')
            ->where('model', $resource)
            ->count() > 0;
    }

    public function canSee($resource)
    {
        return app('user_is_admin')
            ||
            app('nova_permissions')
                ->where('model', $resource)
                ->whereIn('ability', [NovaResourcePermission::PERMISSION_CRUD, NovaResourcePermission::PERMISSION_READ])
                ->count() > 0;
    }

    public function canCreate($resource)
    {
        return app('user_is_admin')
            ||
            app('nova_permissions')
                ->where('model', $resource)
                ->whereIn('ability', [NovaResourcePermission::PERMISSION_CRUD, NovaResourcePermission::PERMISSION_CREATE])
                ->count() > 0;
    }

    public function canUpdate($resource)
    {
        return app('user_is_admin')
            ||
            app('nova_permissions')
                ->where('model', $resource)
                ->whereIn('ability', [NovaResourcePermission::PERMISSION_CRUD, NovaResourcePermission::PERMISSION_UPDATE])
                ->count() > 0;
    }

    public function canDelete($resource)
    {
        return app('user_is_admin')
            ||
            app('nova_permissions')
                ->where('model', $resource)
                ->whereIn('ability', [NovaResourcePermission::PERMISSION_CRUD, NovaResourcePermission::PERMISSION_DELETE])
                ->count() > 0;
    }

    public function rewardClaims()
    {
        return $this->hasMany(LeveredgeRewardClaim::class, 'user_id');
    }

    public function internationalRewardClaims()
    {
        return $this->hasMany(InternationalStudentHealthInsuranceClaim::class, 'user_id');
    }

    public function screenshotClaims()
    {
        return $this->hasMany(ScreenshotClaim::class, 'user_id');
    }

    public function accessTheDeals()
    {
        return $this->hasMany(AccessTheDeal::class, 'user_id');
    }

    public function firstDealAccessed()
    {
        return $this->hasOne(AccessTheDeal::class, 'user_id')
            ->whereNotNull('net_revenue')
            ->where('net_revenue', '!=', 0)
            ->oldest();
    }

    public function firstLoanDealAccessed()
    {
        return $this->hasOne(AccessTheDeal::class, 'user_id')
            ->where('loan_status_id',8)
            ->whereNotNull('net_revenue')
            ->where('net_revenue', '!=', 0)
            ->whereHas('deal', function (Builder $query) {
                $query->whereIn('deal_type_id',[1,2,3,4]);
            })
            ->oldest();
    }

    public function firstInsuranceDealAccessed()
    {
        return $this->hasOne(AccessTheDeal::class, 'user_id')
            ->where('loan_status_id',8)
            ->whereNotNull('net_revenue')
            ->where('net_revenue', '!=', 0)
            ->whereHas('deal', function (Builder $query) {
                $query->where('deal_type_id',5);
            })
            ->oldest();
    }

    public function hasAccessedADealWithLeverEdgeRewards()
    {
        $dealsWithRewards = Deal::whereNotNull('reward_program')->pluck('id');

        return AccessTheDeal::where('user_id',$this->id)->whereIn('deal_id',$dealsWithRewards)->exists();
    }

    public function userRefiFlow()
    {
        return $this->hasOne(UserRefiFlow::class, 'user_id');
    }

    public function tracking()
    {
        return $this->hasOne(UserFlowTracking::class, 'user_id');
    }

    public function userClients()
    {
        return $this->hasMany(UserClient::class);
    }

    public function isPartOfExperiment(Experiment $experiment)
    {
        if ($this->userClients) {
            $relatedClientIds = UserClient::where('user_id',$this->id)
                ->pluck('client_id');

            return ExperimentClient::whereIn('client_id',$relatedClientIds)
                ->where('experiment_id',$experiment->id)
                ->exists();
        }
    }

    /**
     * @param Collection|Experiment[] $experiments
     * @return mixed
     */
    public function isPartOfExperiments(Collection $experiments)
    {
        if ($this->userClients) {
            $relatedClientIds = UserClient::where('user_id',$this->id)
                ->pluck('client_id');

            return ExperimentClient::whereIn('client_id',$relatedClientIds)
                ->whereIn('experiment_id',$experiments->pluck('id'))
                ->exists();
        }
    }

    public function autoRefinanceApplications()
    {
        return $this->hasMany(AutoRefinanceApplication::class);
    }

    public function partnerClaims()
    {
        return $this->hasMany(PartnerClaim::class, 'partner_id');
    }

    public function mailchimpAutomatedCampaignUser()
    {
        return $this->hasMany(MailchimpAutomatedCampaignUser::class);
    }

    public function questionFlowResponders()
    {
        return $this->morphMany(QuestionFlowResponder::class, 'responder');
    }

    public function questionPageResponders()
    {
        return $this->morphMany(QuestionPageResponder::class, 'responder');
    }

    public function mailchimpActivity()
    {
        return $this->hasMany(MailchimpActivity::class, 'user_id');
    }

    public function deleteRequest()
    {
        return $this->hasOne(DeleteRequest::class, 'user_id');
    }

    public function questionFlowValidationErrors()
    {
        return $this->morphMany(QuestionFlowValidationError::class, 'memberable');
    }
}
