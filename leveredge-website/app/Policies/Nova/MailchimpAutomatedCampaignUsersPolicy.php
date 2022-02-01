<?php


namespace App\Policies\Nova;


use App\MailchimpAutomatedCampaignUser;

class MailchimpAutomatedCampaignUsersPolicy extends AbstractNovaPermissionHandler
{
    public $resource = MailchimpAutomatedCampaignUser::class;
}
