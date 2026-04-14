<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['badge', 'title', 'description', 'questions'];

    protected $casts = [
        'questions' => 'array',
    ];
}
