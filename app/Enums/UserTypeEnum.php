<?php

namespace App\Enums;

abstract class UserTypeEnum
{
    public const SUPER_ADMIN = 'super_admin';
    public const ADMIN = 'admin';

    public static function getConstants()
    {
        $reflection = new \ReflectionClass(self::class);

        return $reflection->getConstants();

    }//end of getConstants

}//end of enum class
