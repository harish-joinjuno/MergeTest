<?php


namespace App\MailingList\Rules\Exceptions;

class StaticPropertyNotDefinedException extends \Exception
{
    public function setMessage($class, $property)
    {
        $this->message = "Child class [$class] failed to define static [$property] property";

        return $this;
    }
}
