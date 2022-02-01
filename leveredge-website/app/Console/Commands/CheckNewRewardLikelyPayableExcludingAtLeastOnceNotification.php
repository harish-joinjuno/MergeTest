<?php

namespace App\Console\Commands;

use App\Jobs\ReadyToPayNotificationJob;
use App\LeveredgeRewardClaim;
use App\LrcNotificationSent;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class CheckNewRewardLikelyPayableExcludingAtLeastOnceNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:lrc-likely-payable-excluded-paid-once';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if notification for lrc likely payable excluded at least paid once should be sent';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $query = LeveredgeRewardClaim::query();

        $query = $query->whereNotNull('access_the_deal_id')->whereHas('accessTheDeal',function(Builder $query) {
            $query->where('loan_status_id',\App\DealStatus::SIGNED_THE_LOAN)
                ->where('disbursed_amount','>',0)
                ->where('reward_amount', '>', 0);
        });

        $query->whereDoesntHave('distributions',function (Builder $query) {
            $query->where('payment_completed',1);
        });

        $query->whereDoesntHave('likelyPayableExcludedAtLeastOnceNotification');

        $query->get()
            ->each(function (LeveredgeRewardClaim $leveredgeRewardClaim) {
                dispatch(new ReadyToPayNotificationJob('Leveredge Reward Claim Likely Payable Excluded Paid Once', url("nova/resources/leveredge-reward-claims/{$leveredgeRewardClaim->id}")));

                $lrcNotification = new LrcNotificationSent();
                $lrcNotification->leveredge_reward_claim_id = $leveredgeRewardClaim->id;
                $lrcNotification->type = LrcNotificationSent::LIKELY_PAYABLE_EXCLUDED_PAID_ONCE;
                $lrcNotification->sent =  true;
                $lrcNotification->save();
            });
    }
}
