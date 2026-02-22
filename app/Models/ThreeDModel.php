<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreeDModel extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'model_path',
        'thumbnail_path',
        'settings',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
