<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LunaSession extends Model
{
    protected $guarded = [];

    protected $casts = [
        'messages' => 'array',
        'expires_at' => 'datetime',
    ];
}
