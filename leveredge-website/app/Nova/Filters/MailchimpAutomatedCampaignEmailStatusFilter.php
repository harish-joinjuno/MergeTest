<?php

namespace App\Nova\Filters;

use App\MailchimpAutomatedCampaignUser;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class MailchimpAutomatedCampaignEmailStatusFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public $name = 'Status';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if ($value === MailchimpAutomatedCampaignUser::STATUS_DELETED) {
            return $query->onlyTrashed();
        }

        return $query->where('status', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            MailchimpAutomatedCampaignUser::STATUS_DISPATCHING        => MailchimpAutomatedCampaignUser::STATUS_DISPATCHING,
            MailchimpAutomatedCampaignUser::STATUS_CALL_SENT          => MailchimpAutomatedCampaignUser::STATUS_CALL_SENT,
            MailchimpAutomatedCampaignUser::STATUS_PRE_DISPATCHING    => MailchimpAutomatedCampaignUser::STATUS_PRE_DISPATCHING,
            MailchimpAutomatedCampaignUser::STATUS_VALIDATED          => MailchimpAutomatedCampaignUser::STATUS_VALIDATED,
            MailchimpAutomatedCampaignUser::STATUS_PENDING_VALIDATION => MailchimpAutomatedCampaignUser::STATUS_PENDING_VALIDATION,
            MailchimpAutomatedCampaignUser::STATUS_DELETED            => MailchimpAutomatedCampaignUser::STATUS_DELETED,
        ];
    }
}
