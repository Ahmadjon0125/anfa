<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [
    'subtitle',
    'title', 
    'description', 
    'image_path', 
    'absorption_rate', 
    'course_duration', 
    'capsule_count',
    'primary_link',
    'secondary_link',
    'seo_title',
    'seo_description',
];
}
