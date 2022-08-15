<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AboutUs extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'icon',
        'image',
        'type',
        'links',
        'video',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'links' => 'array'
    ];
}
