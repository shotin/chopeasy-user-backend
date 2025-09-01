<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    protected $fillable = [
        'vendor_id',
        'products',
        'category_id',
        'category_name'
    ];

    protected $casts = [
        'products' => 'array',
    ];
}
