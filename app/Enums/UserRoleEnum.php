<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case CUSTOMER = 'customer';
    case DRIVER = 'driver';
    case ADMIN = 'admin';
}
