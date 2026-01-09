<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorProfile extends Model
{
    protected $fillable = [
        'vendor_id',
        'description',
        'store_type',
        'delivery_time',
        'logo',
        'latitude',
        'longitude',
    ];

     public function vendorOrders()
    {
        return $this->hasMany(VendorOrder::class, 'vendor_id', 'vendor_id');
    }
}