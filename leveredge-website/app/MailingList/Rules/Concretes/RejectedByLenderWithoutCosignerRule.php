<?php


namespace App\MailingList\Rules\Concretes;

use App\AccessTheDeal;
use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\User;

/**
 * @property $dealId
 * @property $loanStatusesIds
 */
class RejectedByLenderWithoutCosignerRule implements MailingListRuleInterface
{
    protected $dealId;

    public function __construct($dealId)
    {
        $this->dealId = $dealId;
    }

    public function passes(User $user)
    {
        $hasRejectedByLenderStatuses = AccessTheDeal::where('user_id',$user->id)
            ->where('deal_id',$this->dealId)
            ->where('loan_status_id', 9)
            ->get();

        if ($hasRejectedByLenderStatuses->count()) {
            //Check if there is approved loan status for this deal for this user
            $hasApprovedStatus = AccessTheDeal::where('user_id',$user->id)
                ->where('deal_id',$this->dealId)
                ->whereIn('loan_status_id', [5,6,7,8,11,12,13])
                ->exists();

            if ($hasApprovedStatus) {
                return false;
            }

            $properties = $hasRejectedByLenderStatuses->filter(function ($accessTheDeal) {
                return ! empty($accessTheDeal->properties);
            });

            // If there are no custom properties we assume it's w/o co-signer
            if (! $properties->count()) {
                return true;
            }

            $hasCosigner = false;
            $properties->each(function ($accessTheDeal) use (&$hasCosigner) {
                if (isset($accessTheDeal->properties->cosigneryn) && $accessTheDeal->properties->cosigneryn === 'TRUE') {
                    $hasCosigner = true;
                }
            });
            // If there is no-cosigner this record is eligible for this mailchimp automated campaign
            return ! $hasCosigner;
        }

        return false;
    }
}
