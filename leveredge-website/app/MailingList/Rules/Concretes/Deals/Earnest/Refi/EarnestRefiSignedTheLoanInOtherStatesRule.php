<?php


namespace App\MailingList\Rules\Concretes\Deals\Earnest\Refi;


class EarnestRefiSignedTheLoanInOtherStatesRule extends EarnestRefiInOtherStates
{
    protected static $loanStatusesIds = [8];
}
