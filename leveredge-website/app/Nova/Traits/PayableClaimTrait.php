<?php


namespace App\Nova\Traits;

use App\Payment;
use App\PaymentMethod;
use App\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

/**
 * Trait PayableClaimTrait
 * @package App\Contracts
 * @property int $amount
 * @property-read PaymentMethod $paymentMethod
 * @property-read User $payer
 * @property-read User $claimant
 * @property-read string|null $payment_description
 * @property-read int $payment_amount
 * @property bool $payment_completed
 * @property int $payment_id
 *
 */
trait PayableClaimTrait
{
    /**
     * @return int
     */
    public function getPaymentAmountAttribute()
    {
        return $this->amount;
    }

    /**
     * @return PaymentMethod
     */
    public function getPayableMethodAttribute()
    {
        return $this->paymentMethod;
    }

    /**
     * @return User|null
     */
    public function getPayerAttribute()
    {
        return user();
    }

    /**
     * @return User
     */
    public function getClaimantAttribute()
    {
        return $this->claimant;
    }

    /**
     * @param bool $value
     */
    public function setPaymentCompletedAttribute($value)
    {
        $this->attributes['payment_completed'] = $value;
    }

    public function setPaymentIdAttribute($value)
    {
        $this->attributes['payment_id'] = $value;
    }

    /**
     * @return string|null
     */
    public function getPaymentDescriptionAttribute()
    {
        if ($this->id) {
            return 'For ' . static::class . $this->id;
        }

        return null;
    }

    public function pay()
    {
        $paymentProvider = $this->getPayableMethodAttribute()->getPaymentProvider();
        $payment         = $paymentProvider::send(
            $this->payer,
            $this->claimant,
            $this->payment_amount,
            $this->payment_description
        );

        if ($payment instanceof Payment) {
            $this->payment_completed = true;
            $this->payment_id        = $payment->id;
            $this->save();

            $mailable = $this->getMailable();
            if ($mailable) {
                Mail::to($this->claimant)->send(new $mailable($this->claimant, $payment));
            }
        } else {
            throw new \Exception("Payment Provider did not return Payment Model");
        }
    }
}
