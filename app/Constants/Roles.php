<?php

namespace App\Constants;

class Roles
{
    public const ADMIN = 'admin';
    public const CUSTOMER = 'customer';

    public static function exists(string $role): bool
    {
        return in_array($role, [self::ADMIN, self::CUSTOMER]);
    }
}
