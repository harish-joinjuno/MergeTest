<?php


namespace App\MailingList\Rules\Contracts;


use App\User;

interface MailingListRuleInterface
{
    public function passes(User $user);
}
