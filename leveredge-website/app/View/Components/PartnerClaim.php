<?php

namespace App\View\Components;

use App\PaymentMethod;
use App\User;
use Illuminate\View\Component;

class PartnerClaim extends Component
{

    public $amountToBePaid = 0;
    public $partner;
    public $paymentMethods;
    public $earnedAmount;
    public $amountInReview;
    public $amountPaid;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $partner)
    {
        $this->partner         = $partner;
        $this->earnedAmount    = $this->partner->partnerProfile->contractType->calculateEarnedAmount($partner);
        $this->amountInReview  = $this->partner->partnerClaims()->wherePaymentCompleted(false)->sum('amount');
        if ($this->earnedAmount > 0) {
            $this->amountPaid      = $this->partner->partnerClaims()->wherePaymentCompleted(true)->sum('amount');
            $this->amountToBePaid  = $this->earnedAmount-($this->amountPaid+$this->amountInReview);
        }
        $this->paymentMethods  = PaymentMethod::whereIn('name', [
            PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK,
            PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD,
        ])->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.partner-claim');
    }
}
