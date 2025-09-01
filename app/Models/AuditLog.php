<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function causer()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

    public function action()
    {
        return $this->morphTo(null, 'action_type', 'action_id');
    }
}
