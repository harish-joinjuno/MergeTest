<?php


namespace App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad;


class EarnestUndergradDealRejectedByLenderRule extends EarnestUndergradLoan
{
    protected static $loanStatusesIds = [9];
}
