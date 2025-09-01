<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'causer',
        'model',
        'error_message',
        'error_line',
        'error_trace',
        'request_url',
        'request_method',
        'request_data',
        'request_ip',
        'user_agent',
        'context',
    ];

    protected $casts = [
        'request_data' => 'array',
        'context' => 'array',
    ];
}
