<?php


namespace App\Integrations;

use App\AccessTheDeal;
use App\DealStatus;
use App\DealStatusApplicability;
use App\UserProfile;
use HubSpot\Client\Crm\Deals\ApiException;
use HubSpot\Client\Crm\Deals\Model\SimplePublicObjectInput;
use HubSpot\Factory;

class HubspotClient
{
    public $hubspot;

    public function __construct($hubspot = null)
    {
        if (! $hubspot) {
            $hubspot = Factory::createWithApiKey(config('services.hubspot.api_key'));
        }

        $this->hubspot = $hubspot;
    }

    public function setDealProperties($properties, $dealId)
    {
        $newProperties = new SimplePublicObjectInput();
        $newProperties->setProperties($properties);

        try {
            $this->hubspot->crm()
                ->deals()
                ->basicApi()
                ->update($dealId, $newProperties);
        } catch (ApiException $e) {
        }
    }

    public function countRegistrations($userProfiles)
    {
        return $userProfiles->count();
    }

    public function countCompleteProfiles($userProfiles)
    {
        $userProfiles->filter(function ($item) {
            return $item->signup_progress === UserProfile::SIGNUP_PROGRESS_COMPLETED;
        })->count();
    }

    public function countCompleteProfilesHighQualities($userProfiles)
    {
        $userProfiles->filter(function ($item) {
            return $item->quality === UserProfile::QUALITY_GOOD;
        })->count();
    }

    public function countClickedToProviders($userProfiles)
    {
        return AccessTheDeal::whereIn('user_id',$userProfiles->pluck('user_id'))->distinct('user_id')->count();
    }

    public function countReceivedQuotes($userProfiles)
    {
        $userIds                      = $userProfiles->pluck('user_id')->toArray();
        $count                        = 0;
        foreach ($userIds as $userId) {
            if (AccessTheDeal::whereLoanStatusId(DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID)->whereUserId($userId)->exists()) {
                $count++;

                continue;
            }

            if (AccessTheDeal::whereLoanStatusId(DealStatus::RECEIVED_QUOTES_ID)->whereUserId($userId)->exists()) {
                $count++;

                continue;
            }

            if (AccessTheDeal::whereLoanStatusId(DealStatus::SIGNED_THE_LOAN)->whereUserId($userId)->exists()) {
                $count++;

                continue;
            }

            $dealsAccessedByUser = AccessTheDeal::whereUserId($userId)->get();
            foreach ($dealsAccessedByUser as $accessTheDeal) {
                if ($this->hasProgressedPastQuote($accessTheDeal)) {
                    $count++;

                    continue;
                }
            }
        }

        return $count;
    }

    public function countSignedLoans($userProfiles)
    {
        $userIds = $userProfiles->pluck('user_id')->toArray();

        return AccessTheDeal::whereIn('user_id', $userIds)->where('loan_status_id', DealStatus::SIGNED_THE_LOAN)->distinct('user_id')->count('user_id');
    }

    private function hasProgressedPastQuote(AccessTheDeal $accessTheDeal)
    {

        // Check if Deal has Quote or Preliminary Quote
        $quoteStatusApplicability = DealStatusApplicability::whereDealId($accessTheDeal->deal_id)
            ->whereIn('deal_status_id', [
                DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID,
                DealStatus::RECEIVED_QUOTES_ID,
            ])->orderBy('sort_order', 'asc')
            ->first();

        // If it doesn't then false
        if (!$quoteStatusApplicability) {
            return false;
        }

        // Find all the deal statuses that indicate progress beyond the quote
        $dealStatusesBeyondQuote = DealStatusApplicability::whereDealId($accessTheDeal->deal_id)
            ->where('sort_order','>=',$quoteStatusApplicability->sort_order)
            ->pluck('deal_status_id');

        // Check if any of the access the deal records have progressed beyond the quote
        return AccessTheDeal::where('user_id',$accessTheDeal->user_id)
            ->whereIn('loan_status_id',$dealStatusesBeyondQuote)
            ->where('deal_id',$accessTheDeal->deal_id)->exists();
    }
}
