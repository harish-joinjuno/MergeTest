<?php


namespace Tests\Builders;

use App\AccessTheDeal;
use App\Deal;
use App\LeveredgeRewardClaim;
use App\PaymentMethod;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;

class LeverEdgeRewardClaimBuilder
{
    use WithFaker;

    /** @var LeveredgeRewardClaim */
    public $leveredgeRewardClaim;

    public function __construct($attributes = [])
    {
        $this->faker                    = $this->makeFaker('en_US');
        $this->leveredgeRewardClaim     = factory(LeveredgeRewardClaim::class)->make($attributes);
    }

    public function save()
    {
        $this->leveredgeRewardClaim->save();

        return $this;
    }

    public function get()
    {
        return $this->leveredgeRewardClaim;
    }

    public function withUser(User $user = null)
    {
        if (!$user) {
            $user = User::inRandomOrder()->first();
        }

        $this->leveredgeRewardClaim->user_id = $user->id;

        return $this;
    }

    public function withDeal(Deal $deal = null)
    {
        if (!$deal) {
            $deal = Deal::inRandomOrder()->first();
        }

        $this->leveredgeRewardClaim->deal_id = $deal->id;

        return $this;
    }

    public function withAccessTheDeal(AccessTheDeal $accessTheDeal = null)
    {
        if (!$accessTheDeal) {
            if ($this->leveredgeRewardClaim->user_id && $this->leveredgeRewardClaim->deal_id) {
                $accessTheDeal = AccessTheDeal::where('user_id', $this->leveredgeRewardClaim->user_id)
                    ->where('deal_id',$this->leveredgeRewardClaim->deal_id)
                    ->inRandomOrder()
                    ->first();
            } else {
                throw new \Exception('Need to set User ID and Deal ID before accessing the deal');
            }
        }

        if ($accessTheDeal) {
            $this->leveredgeRewardClaim->access_the_deal_id = $accessTheDeal->id;
        } else {
            throw new \Exception('No access the deal record with set user id and deal id');
        }

        return $this;
    }

    public function withPaymentMethod(PaymentMethod $paymentMethod = null)
    {
        if (!$paymentMethod) {
            $paymentMethod = PaymentMethod::where('name',PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)->first();
        }
        $this->leveredgeRewardClaim->payment_method_id = $paymentMethod->id;

        return $this;
    }

    public function withLoanAmount(int $loanAmount = null)
    {
        if (!$loanAmount) {
            $loanAmount = random_int(35000,120000);
        }

        $this->leveredgeRewardClaim->loan_amount = $loanAmount;

        return $this;
    }

    public function withRewardAmount(int $rewardAmount = null)
    {
        if (!$rewardAmount) {
            $rewardAmount = $this->leveredgeRewardClaim->calculateRewardAmount();
        }

        $this->leveredgeRewardClaim->reward_amount = $rewardAmount;

        return $this;
    }

    public function withIsPaid(bool $is_paid = true)
    {
        $this->leveredgeRewardClaim->is_paid = $is_paid;
    }
}
