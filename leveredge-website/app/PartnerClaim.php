<?php

namespace App;

use App\Jobs\ReadyToPayNotificationJob;
use App\Jobs\SyncScholarshipEntrantWithMailcoachJob;
use App\Mail\PartnerClaimAmazonGiftCard;
use App\Mail\PartnerClaimDigitalCheck;
use App\Nova\Traits\PayableClaimTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Carbon;

/**
 * @package App
 * @property int                    $id
 * @property int                    $partner_id
 * @property int                    $amount
 * @property int                    $payment_method_id
 * @property int                    $payment_id
 * @property bool                   $payment_completed
 * @property Carbon                 $created_at
 * @property Carbon                 $updated_at
 * @property-read User              $partner
 * @property-read Payment           $payment
 * @property-read string            $status
 * @property-read int               $payment_amount
 * @property-read PaymentMethod     $paymentMethod
 * @property-read User              $claimant
 * @property-read User|null         $payer
 * @property-read string|null       $payment_description
 * @property-read Mailable          $mailable
 */
class PartnerClaim extends Model
{
    protected $fillable = [
        'partner_id',
        'payment_method_id',
        'amount',
    ];

    use PayableClaimTrait;

    protected static function booted()
    {
        static::created(function ($partnerClaim) {
            dispatch(new ReadyToPayNotificationJob('Partner Claim', url("/nova/resources/partner-claims/{$partnerClaim->id}")));
        });
    }

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function status()
    {
        $value = $this->payment_completed;
        switch ($value) {
            case 1:
                return 'Paid';
            case 0:
                return 'In Review';
        }
    }

    public function getClaimantAttribute()
    {
        return $this->partner;
    }

    public function getPaymentAmountAttribute()
    {
        return $this->amount;
    }

    public function getMailable()
    {
        switch ($this->paymentMethod->name) {
            case PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK:
                return PartnerClaimDigitalCheck::class;

                break;

            case PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD:
                return PartnerClaimAmazonGiftCard::class;

                break;
            default: break;
        }
    }
}
