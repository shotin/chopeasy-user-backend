<?php

namespace App\Enums;

enum IdentifierTypeEnums: string
{
    case PHONENUMBER = 'phone_number';
    case EMAIL = 'email';
    case USERNAME = 'USERNAME';
}