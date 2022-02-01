<?php

namespace App;

use App\Jobs\CreateDisclosureDetailForLeveredgeRewardClaim;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 *
 * @property User $user
 * @property int $user_id
 *
 * @property Deal $deal
 * @property int $deal_id
 *
 * @property AccessTheDeal $accessTheDeal
 * @property int $access_the_deal_id
 *
 * @property PaymentMethod $paymentMethod
 * @property int $payment_method_id
 *
 * @property int $payment_id
 * @property Payment $payment
 *
 * @property int $reward_amount
 * @property int $loan_amount
 *
 * @property-read LeveredgeRewardDistribution[] $distributions
 *
 * @property string $credit_score
 * @property string $cosigner_credit_score
 * @property int $annual_income
 * @property array $properties
 * @property string $admin_notes
 * @property boolean $payment_completed
 * @property int $cosigner_annual_income
 *
 * @property string $file_name
 * @property string $file_path
 * @property File $file
 *
 * @property-read string $status
 * @property Carbon $created_at
 * @property-read DisclosureDetail $disclosureDetail
 */
class LeveredgeRewardClaim extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'deal_id',
        'access_the_deal_id',
        'payment_method_id',
        'payment_id',
        'reward_amount',
        'loan_amount',
        'credit_score',
        'cosigner_credit_score',
        'annual_income',
    ];

    protected $appends = [
        'date_submitted',
        'status',
    ];

    protected $with = [
        'user',
        'deal',
        'paymentMethod',
    ];

    protected $casts = [
        'properties'        => 'array',
        'payment_completed' => 'boolean',
    ];

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    public function accessTheDeal()
    {
        return $this->belongsTo(AccessTheDeal::class, 'access_the_deal_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function getDateSubmittedAttribute()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    public static function getDealsWithRewardPrograms()
    {
        return Deal::whereNotNull('reward_program')->get();
    }

    public function calculateRewardAmount()
    {
        return $this->deal->calculateRewardAmount($this->loan_amount);
    }

    public function distributions()
    {
        return $this->hasMany(LeveredgeRewardDistribution::class, 'leveredge_reward_claim_id');
    }

    public function disclosureDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(DisclosureDetail::class);
    }

    public function getDisbursedLoanAmountAttribute()
    {
        if ($this->accessTheDeal && $this->accessTheDeal->disbursed_amount) {
            return $this->accessTheDeal->disbursed_amount;
        }

        return 0;
    }

    public function getStatusAttribute()
    {
        if ($this->payment_completed) {
            return "All Rewards Have Been Sent";
        }

        if (!$this->payment_completed && $this->distributions()->where('payment_completed',true)->exists()) {
            return "Partial Rewards Have Been Sent. We are waiting for the remainder of the loan to be disbursed to
            send additional rewards. If your entire loan has been disbursed, please reach out to us at support@joinjuno.com";
        }

        if ($this->accessTheDeal) {
            if ($this->accessTheDeal->disbursed_amount > 0) {
                return "We have everything we need to send you the funds. You should receive it within 7 days";
            }

            if ($this->accessTheDeal->deal->dealType->id == DealType::REFINANCE_STUDENT_LOAN) {
                return "We've matched your request with a record from the reports we receive from the partner.
                Once we get confirmation that everything's all set, we'll send you the reward. If 9 weeks have
                already passed since you finalized the process, please reach out via hello@joinjuno.com.";
            }

            return "We've matched your request with a record from the reports we receive from the partner. However, it
            doesn't indicate that the loan has been disbursed. We are waiting for the status to update. If your loan has
            already disbursed, please reach out via hello@joinjuno.com";
        }

        if ($this->created_at->diffInHours(now()) < 24) {
            return "We've received your request. Our automated systems run approx. once per day and they may not
                have had a chance to try and match the information you submitted with the reports from our lenders.
                We recommend checking back in 24 hours.";
        }

        return "Our automated systems have not been able to find a match between the information you submitted
            and the information we receive from our partners. We will try to look through it manually. While we will
            continue to work to find a match, we recommend you contact us at support@joinjuno.com if you see this
            status for several days";
    }

    public function likelyPayableExcludedAtLeastOnceNotification()
    {
        return $this->hasOne(LrcNotificationSent::class, 'leveredge_reward_claim_id')
            ->where('type', LrcNotificationSent::LIKELY_PAYABLE_EXCLUDED_PAID_ONCE)
            ->where('sent', 1);
    }

    public function likelyPayableAtLeastOnceNotification()
    {
        return $this->hasOne(LrcNotificationSent::class, 'leveredge_reward_claim_id')
            ->where('type', LrcNotificationSent::LIKELY_PAYABLE_PAID_ONCE)
            ->where('sent', 1);
    }

    protected static function booted()
    {
        parent::booted();

        static::created(function ($leveredgeRewardRequest) {
            dispatch(new CreateDisclosureDetailForLeveredgeRewardClaim($leveredgeRewardRequest));
        });
    }
}
