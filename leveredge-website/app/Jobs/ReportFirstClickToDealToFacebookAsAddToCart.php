<?php


namespace App\Jobs;

use App\AccessTheDeal;
use App\Jobs\Abstracts\ReportEventToFacebook;

class ReportFirstClickToDealToFacebookAsAddToCart extends ReportEventToFacebook
{
    public $accessTheDeal;

    public function __construct(AccessTheDeal $accessTheDeal)
    {
        $this->accessTheDeal = $accessTheDeal;
        parent::__construct();
    }

    protected function getEventInformation()
    {
        $deal                         = $this->accessTheDeal->deal;
        $user                         = $this->accessTheDeal->user;
        $dealsAccessedCount           = AccessTheDeal::whereDealId($deal->id)->whereUserId($user->id)->count();
        $accessTheDealCountForEventId = $user->accessTheDeals->count() - 1;
        if ($dealsAccessedCount == 1) {
            return [
                'category'  => $deal->dealType->name,
                'action'    => 'AddToCart',
                'label'     => $deal->slug,
                'value'     => 0,
                'event_id'  => $user->id . $accessTheDealCountForEventId,
            ];
        }

        return null;
    }
}
