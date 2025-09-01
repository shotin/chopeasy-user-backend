<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProductItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'category_id',
        'product_id',
        'name',
        'uom',
        'quantity',
        'price',
        'category_name',
        'logo',
    ];

    /**
     * A vendor product item belongs to a vendor (user).
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
