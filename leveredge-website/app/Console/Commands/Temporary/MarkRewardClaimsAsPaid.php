<?php

namespace App\Console\Commands\Temporary;

use App\LeveredgeRewardClaim;
use Illuminate\Console\Command;

class MarkRewardClaimsAsPaid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reward-claims:mark-as-paid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $leveredgeRewardClaims = LeveredgeRewardClaim::all();
        $leveredgeRewardClaims->each(function ($leveredgeRewardClaim) {
            $payedAmount = (int)$leveredgeRewardClaim->distributions()->where('payment_completed', true)->sum('amount');

            if ($payedAmount === $leveredgeRewardClaim->reward_amount) {
                $leveredgeRewardClaim->payment_completed = true;
                $leveredgeRewardClaim->save();
            }
        });

        $this->output->comment(LeveredgeRewardClaim::wherePaymentCompleted(true)->count());
    }
}
