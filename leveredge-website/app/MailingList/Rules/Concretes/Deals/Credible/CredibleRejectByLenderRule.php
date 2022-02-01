<?php


namespace App\MailingList\Rules\Concretes\Deals\Credible;


class CredibleRejectByLenderRule extends CredibleLoan
{
    protected static $loanStatusesIds = [9];
}
