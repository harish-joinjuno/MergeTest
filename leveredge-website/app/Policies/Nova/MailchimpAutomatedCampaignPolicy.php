<?php


namespace App\Policies\Nova;


use App\MailchimpAutomatedCampaign;

class MailchimpAutomatedCampaignPolicy extends AbstractNovaPermissionHandler
{
    public $resource = MailchimpAutomatedCampaign::class;
}
