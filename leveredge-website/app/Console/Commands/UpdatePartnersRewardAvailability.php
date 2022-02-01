<?php

namespace App\Console\Commands;

use App\Mail\PartnersRewardAvailability;
use App\PartnerProfile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UpdatePartnersRewardAvailability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'partners:update-reward-availability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update partner\'s reward every month';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        PartnerProfile::orderBy('id')
            ->chunk(100, function ($partnerProfiles) {
                $partnerProfiles->each(function (PartnerProfile $partnerProfile) {
                    $earnedAmount    = $partnerProfile->contract_type->calculateEarnedAmount($partnerProfile->user);
                    $claimedAmount   = $partnerProfile->user->partnerClaims()->sum('amount');
                    if ($earnedAmount - $claimedAmount > 0 ) {
                        Mail::to($partnerProfile->user->email)->send(new PartnersRewardAvailability($partnerProfile->user));
                    }
                });
            });
    }
}
