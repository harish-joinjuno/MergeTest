<?php

namespace App\Nova\Actions;

use App\MailchimpAutomatedCampaignUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ValidateMailchimpCampaignMember extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function (MailchimpAutomatedCampaignUser $mailchimpAutomatedCampaignUser) {
            $mailchimpAutomatedCampaignUser->status = MailchimpAutomatedCampaignUser::STATUS_VALIDATED;
            $mailchimpAutomatedCampaignUser->validated = true;
            $mailchimpAutomatedCampaignUser->save();
        });
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
