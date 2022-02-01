<?php


namespace App\MailingList\Rules\Concretes\Deals\Earnest\Graduate;


class EarnestGraduateDealRejectedByLenderRule extends EarnestGraduateLoan
{
    protected static $loanStatusesIds = [9];
}
