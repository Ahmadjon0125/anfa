<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'badge',
        'title',
        'description',
        'image_path',
        'form_title',
        'form_subtitle',
        'form_text'
    ];
}
