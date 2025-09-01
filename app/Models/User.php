<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles, Notifiable, SoftDeletes;

    protected $fillable = [
        'fullname',
        'middlename',
        'guardianname',
        'username', 
        'main_wallet',
        'food_wallet',
        'phoneno',
        'address',
        'lga',
        'state',
        'country',
        'user_type',
        'email',
        'gender',
        'image',
        'cover_photo',
        'date_of_birth',
        'last_login',
        'email_verified_at',
        'fcm_token',
        'ip_address',
        'continent',
        'is_verified',
        'is_active',
        'can_login',
        'two_fa',
        'password',
        'otp_expires_at',
        'email_otp',
        'main_wallet',
        'food_wallet'
    ];

    protected $hidden = ['password', 'remember_token', 'email_otp'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'can_login' => 'boolean',
        'two_fa' => 'boolean',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($this, $token));
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function shippingAddresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
