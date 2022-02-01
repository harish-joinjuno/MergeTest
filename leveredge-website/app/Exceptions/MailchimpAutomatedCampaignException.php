<?php


namespace App\Exceptions;


class MailchimpAutomatedCampaignException extends \Exception
{
    private $error;

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }
}
