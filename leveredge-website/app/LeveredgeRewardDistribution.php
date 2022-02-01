<?php

namespace App;

use App\Jobs\SyncScholarshipEntrantWithMailcoachJob;
use App\Mail\AmazonLeveredgeRewardClaimMail;
use App\Mail\CheckbookLeveredgeRewardClaimMail;
use App\Mail\FederalLoanTrackerWelcomeEmail;
use App\Nova\Traits\PayableClaimTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Actionable;

/**
 * @property int $leveredge_reward_claim_id
 * @property-read LeveredgeRewardClaim $rewardClaim
 *
 * @property int $payment_record_id
 * @property-read Payment $payment
 *
 * @property int $amount
 * @property int $payment_method_id
 * @property string $status
 * @property boolean $payment_completed
 * @property string $admin_notes
 */
class LeveredgeRewardDistribution extends Model
{
    use PayableClaimTrait,
        Actionable,
        SoftDeletes;

    const STATUS_PENDING_PAYMENT = 'pending payment';

    protected $appends = [
        'payment_method_id',
    ];

    public function rewardClaim()
    {
        return $this->belongsTo(LeveredgeRewardClaim::class, 'leveredge_reward_claim_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_record_id');
    }

    public function getClaimantAttribute()
    {
        return $this->rewardClaim->user;
    }

    public function setPaymentIdAttribute($value)
    {
        $this->attributes['payment_record_id'] = $value;
    }

    public function getPaymentMethodAttribute()
    {
        return $this->rewardClaim->paymentMethod;
    }

    public function getPaymentMethodIdAttribute()
    {
        return $this->rewardClaim->payment_method_id;
    }

    public function getPaymentDescriptionAttribute()
    {
        return 'For Reward Request #' . $this->rewardClaim->id;
    }

    public function getMailable()
    {
        switch ($this->getPaymentMethodAttribute()->name) {
            case PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK:
                return CheckbookLeveredgeRewardClaimMail::class;

                break;

            case PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD:
                return AmazonLeveredgeRewardClaimMail::class;

                break;
            default: break;
        }
    }

    protected static function booted()
    {
        static::saved(function ($leveredgeRewardDistribution) {
            $leveredgeRewardClaim = $leveredgeRewardDistribution->rewardClaim;

            $payedAmount = (int)$leveredgeRewardClaim->distributions()->where('payment_completed', true)->sum('amount');

            if ($payedAmount === $leveredgeRewardClaim->reward_amount) {
                $leveredgeRewardClaim->payment_completed = true;
                $leveredgeRewardClaim->save();
            }
        });
    }
}
