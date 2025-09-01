<?php

namespace App\Enums;

enum VerificationCodeStatusEnums: string
{
    case PENDING = 'pending';
    case VERIFIED = 'verified';
    case EXPIRED = 'expired';
    case REJECTED = 'rejected';
    case RESENT = 'resent';
    case USED = 'used';
}