<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['user_id', 'session_id', 'address_line_1', 'address_line_2', 'city', 'state', 'country', 'postal_code', 'is_default', 'first_name', 'last_name', 'phone_number', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
