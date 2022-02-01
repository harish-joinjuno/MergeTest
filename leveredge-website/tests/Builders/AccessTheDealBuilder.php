<?php


namespace Tests\Builders;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\DealStatusApplicability;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;


class AccessTheDealBuilder
{
    use WithFaker;

    /** @var AccessTheDeal */
    public $accessTheDeal;

    public function __construct($attributes = [])
    {
        $this->faker                    = $this->makeFaker('en_US');
        $this->accessTheDeal    = factory(accessTheDeal::class)->make($attributes);
    }

    public function save()
    {
        $this->accessTheDeal->save();
        return $this;
    }

    public function get()
    {
        return $this->accessTheDeal;
    }

    public function withUser(User $user = null)
    {
        if (!$user) {
            $user = User::inRandomOrder()->first();
        }

        $this->accessTheDeal->user_id = $user->id;
        return $this;
    }

    public function withDeal(Deal $deal = null)
    {
        if (!$deal) {
            $deal = Deal::inRandomOrder()->first();
        }

        $this->accessTheDeal->deal_id = $deal->id;
        return $this;
    }

    public function withLoanStatus(DealStatus $dealStatus)
    {
        if(!$dealStatus){
            if($this->accessTheDeal->deal_id){
                $dealStatus = DealStatusApplicability::where('deal_id',$this->accessTheDeal->deal_id)
                    ->inRandomOrder()
                    ->first()
                    ->dealStatus;
            }else{
                throw new \Exception('Set Deal before setting Deal Status');
            }

        }

        $this->accessTheDeal->loan_status_id = $dealStatus->id;

        return $this;
    }

    public function withLoanAmount(int $loanAmount = null){
        if(!$loanAmount){
            $loanAmount = random_int(35000,120000);
        }

        $this->accessTheDeal->loan_amount = $loanAmount;

        return $this;
    }

}
