<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    protected $fillable = [
        'title',
        'main_action_title',
        'main_actions',
        'center_image',
        'center_stats',
        'composition_title',
        'composition_items'
    ];

    protected $casts = [
        'main_actions' => 'array',
        'center_stats' => 'array',
        'composition_items' => 'array',
    ];
}
