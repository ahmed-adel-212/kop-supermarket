<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'id',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'created_at',
        'updated_at',
    ];

}
