<?php


namespace App\MailingList\Rules\Concretes\Deals\Credible;


class CredibleCompletedApplicationRule extends CredibleLoan
{
    protected static $loanStatusesIds = [8,13];
}
