<?php

namespace App\Enums;

enum GeneralEnums: string
{
    case APPROVED = 'approved';
    case PENDING = 'pending';
    case DECLINED = 'declined';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case VERIFIED = 'verified';
    case EXPIRED = 'expired';
}