<?php


namespace App\MailingList\Rules\Contracts;


use Illuminate\Console\OutputStyle;

interface EligibleUsersListInterface
{
    public function getAll(OutputStyle $output);
}
