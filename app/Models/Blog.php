<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author_name',
        'content',
        'image',
        'status',
        'published_at',
    ];
}
