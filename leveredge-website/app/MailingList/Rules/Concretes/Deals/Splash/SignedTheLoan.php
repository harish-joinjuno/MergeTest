<?php


namespace App\MailingList\Rules\Concretes\Deals\Splash;


use App\MailingList\Rules\Abstracts\AbstractCheckDealStatus;

class SignedTheLoan extends AbstractCheckDealStatus
{
    protected static $loanStatusesIds = [8];

    protected static $dealId = 13;
}
