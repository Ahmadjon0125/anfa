<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = [
        'about_text',
        'instagram',
        'facebook',
        'telegram',
        'linkedin',
        'phone',
        'address',
        'email',
        'work_hours',
    ];
}
