<?php


namespace App\Nova\Traits;


trait MailableClaimTrait
{
    public function getMailable()
    {
        return $this->getPayableMethodAttribute()->getMailable();
    }
}
