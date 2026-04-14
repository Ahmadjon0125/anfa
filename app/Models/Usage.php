<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    protected $fillable = ['title', 'subtitle', 'cards'];

    protected $casts = [
        'cards' => 'array',
    ];
}
