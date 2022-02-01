<?php


namespace App\MailingList\Rules\Concretes\Deals\Earnest\Refi;


class EarnestRefiRejectedByLenderRule extends EarnestRefi
{
    protected static $loanStatusesIds = [9];
}
