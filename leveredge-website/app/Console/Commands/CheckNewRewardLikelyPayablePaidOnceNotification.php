<?php

namespace App\Console\Commands;

use App\Jobs\ReadyToPayNotificationJob;
use App\LeveredgeRewardClaim;
use App\LrcNotificationSent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckNewRewardLikelyPayablePaidOnceNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:lrc-likely-payable-paid-once';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if notification for lrc likely payable at least paid once should be sent';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $result =  collect(DB::select("
select `leveredge_reward_claims`.`id` from `leveredge_reward_claims`
where `access_the_deal_id` is not null
and exists (
    select * from `access_the_deals`
    where `leveredge_reward_claims`.`access_the_deal_id` = `access_the_deals`.`id`
    and `loan_status_id` = ". \App\DealStatus::SIGNED_THE_LOAN . "
    and `disbursed_amount` > 0
    and `reward_amount` > 0
)
and (
    select count(*) from `leveredge_reward_distributions`
        where `leveredge_reward_claims`.`id` = `leveredge_reward_distributions`.`leveredge_reward_claim_id`
        and `leveredge_reward_distributions`.`deleted_at` is null) > 1
        and `leveredge_reward_claims`.`reward_amount` >
        (select SUM(`leveredge_reward_distributions`.`amount`) from `leveredge_reward_distributions`
            where `leveredge_reward_claims`.`id` = `leveredge_reward_distributions`.`leveredge_reward_claim_id`
            and `leveredge_reward_distributions`.`payment_completed` = 1
            and `leveredge_reward_distributions`.`deleted_at` is null
        )
and exists (
    select * from `leveredge_reward_distributions`
    where `leveredge_reward_claims`.`id` = `leveredge_reward_distributions`.`leveredge_reward_claim_id`
    and `payment_completed` = 0
    and `leveredge_reward_distributions`.`deleted_at` is null)
    and `leveredge_reward_claims`.`deleted_at` is null")
        )->pluck('id');


        $query = LeveredgeRewardClaim::query();
        $query->whereIn('id', $result);
        $query->whereDoesntHave('likelyPayableAtLeastOnceNotification');

        $query->get()
            ->each(function (LeveredgeRewardClaim $leveredgeRewardClaim) {
                dispatch(new ReadyToPayNotificationJob('Leveredge Reward Claim Likely Payable Paid At Least Once', url("nova/resources/leveredge-reward-claims/{$leveredgeRewardClaim->id}")));

                $lrcNotification = new LrcNotificationSent();
                $lrcNotification->leveredge_reward_claim_id = $leveredgeRewardClaim->id;
                $lrcNotification->type = LrcNotificationSent::LIKELY_PAYABLE_PAID_ONCE;
                $lrcNotification->sent =  true;
                $lrcNotification->save();
            });
    }
}
