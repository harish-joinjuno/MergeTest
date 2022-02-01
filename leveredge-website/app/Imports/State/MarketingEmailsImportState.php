<?php


namespace App\Imports\State;


class MarketingEmailsImportState
{
    protected static $validations = [];

    /**
     * @param array $validations
     */
    public static function setValidations(array $validations): void
    {
        self::$validations = $validations;
    }

    /**
     * @return array
     */
    public static function getValidations(): array
    {
        return self::$validations;
    }
}
