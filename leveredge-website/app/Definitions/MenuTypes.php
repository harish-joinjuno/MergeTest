<?php
/**
 * Created by PhpStorm.
 * User: kieferwaight
 * Date: 2019-10-27
 * Time: 20:07
 */

namespace App\Definitions;


class MenuTypes
{
    const HEADER = 'header';
    const AUTH_HEADER = 'auth_header';
    const COPYRIGHT = 'copyright';
    const COMPANY = 'company';
    const PRODUCTS = 'products';
    const AUTH_DROPDOWN = 'auth_dropdown';

    /**
     * Get all menu types
     * @return \Illuminate\Support\Collection
     */
    public static function all()
    {
        return collect([
            static::HEADER,
            static::AUTH_HEADER,
            static::COPYRIGHT,
            static::COMPANY,
            static::PRODUCTS,
            static::AUTH_DROPDOWN
        ]);
    }

    /**
     * Get menu types with friendly naming convention
     * @return array
     */
    public static function naming()
    {
        return [
            static::HEADER => 'Header',
            static::AUTH_DROPDOWN => 'Authenticated Drop Down',
            static::AUTH_HEADER => 'Auth Header',
            static::COPYRIGHT => 'Copyright Line',
            static::COMPANY => 'Company Footer Column',
            static::PRODUCTS => 'Products Footer Column'
        ];
    }
}
