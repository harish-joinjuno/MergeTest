<?php


namespace App\Policies\Nova;


use App\MailchimpAutomatedCampaignMailable;

class MailchimpAutomatedCampaignMailablePolicy extends AbstractNovaPermissionHandler
{
    public $resource = MailchimpAutomatedCampaignMailable::class;
}
