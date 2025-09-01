<?php

namespace App\Enums;

enum RolesEnum: string
{
    case customer = 'customer';
    case developer = 'developer';
    case superadmin = 'superadmin';
    case admin = 'admin';
    case financemanager = 'financemanager';
    case guest = 'guest';
}
