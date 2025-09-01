<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'title',
        'review',
        'rating',
        'user_id',
        'session_id'
    ];
}
