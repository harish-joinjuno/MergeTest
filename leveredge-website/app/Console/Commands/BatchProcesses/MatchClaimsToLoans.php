<?php

namespace App\Console\Commands\BatchProcesses;

use App\AccessTheDeal;
use App\DealStatus;
use App\LeveredgeRewardClaim;
use App\LeveredgeRewardDistribution;
use Illuminate\Console\Command;

class MatchClaimsToLoans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'match-claims-to-loans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Attach Clicks to Claims
        $leveredgeRewardClaims = LeveredgeRewardClaim::whereNull('access_the_deal_id')->with('user.accessTheDeals')->get();
        /** @var LeveredgeRewardClaim $leveredgeRewardClaim */
        foreach ($leveredgeRewardClaims as $leveredgeRewardClaim) {
            /** @var AccessTheDeal $accessTheDeal */
            foreach ($leveredgeRewardClaim->user->accessTheDeals as $accessTheDeal) {
                if ($accessTheDeal->loan_status_id === DealStatus::SIGNED_THE_LOAN
                    && $accessTheDeal->deal_id === $leveredgeRewardClaim->deal_id) {
                    $claimsUsingAccessTheDeal = LeveredgeRewardClaim::withTrashed()->where('access_the_deal_id',$accessTheDeal->id)->get();

                    if ($claimsUsingAccessTheDeal->count() == 0) {
                        $leveredgeRewardClaim->access_the_deal_id = $accessTheDeal->id;
                        $leveredgeRewardClaim->save();
                    } else {
                        $canAssign = true;
                        foreach ($claimsUsingAccessTheDeal as $claimUsingAccessTheDeal ) {
                            $canDisassociate = true;
                            // If any of the claims are not trashed, can't assign
                            if (is_null($claimUsingAccessTheDeal->deleted_at)) {
                                $canAssign       = false;
                                $canDisassociate = false;
                            }

                            // If any of the claims (even if trashed) have a completed distribution, then cant assign
                            foreach ($claimUsingAccessTheDeal->distributions as $potentialDistribution) {
                                if ($potentialDistribution->payment_completed == true) {
                                    $canAssign       = false;
                                    $canDisassociate = false;
                                }
                            }

                            if ($canDisassociate) {
                                $claimUsingAccessTheDeal->access_the_deal_id = null;
                                $claimUsingAccessTheDeal->save();
                            }
                        }
                        if ($canAssign) {
                            $leveredgeRewardClaim->access_the_deal_id = $accessTheDeal->id;
                            $leveredgeRewardClaim->save();
                        }
                    }
                }
            }
        }

        // Create Distributions for Claims
        $claimsWithClicksAttached = LeveredgeRewardClaim::whereNotNull('access_the_deal_id')->with('distributions','accessTheDeal')->get();
        /** @var LeveredgeRewardClaim $claim */
        foreach ($claimsWithClicksAttached as $claim) {

            // If the disbursed amount is not greater than zero, then skip
            if (!$claim->accessTheDeal->disbursed_amount > 0) {
                continue;
            }

            // If payment is already completed, then skip
            if ( $claim->payment_completed == true) {
                continue;
            }

            // If distributions already exist that are equal or greater than the disbursed amount, then skip
            $valueOfDistributions         = $claim->distributions->sum('amount');
            $expectedValueOfDistributions = $claim->deal->calculateRewardAmount($claim->accessTheDeal->disbursed_amount);
            if ($valueOfDistributions >= $expectedValueOfDistributions) {
                continue;
            }

            // Create a Distribution for the Delta
            $distribution                            = new LeveredgeRewardDistribution();
            $distribution->amount                    = $expectedValueOfDistributions - $valueOfDistributions;
            $distribution->leveredge_reward_claim_id = $claim->id;
            $distribution->payment_completed         = 0;
            $distribution->admin_notes               = 'Distribution created automatically';
            $distribution->save();
        }
    }
}
