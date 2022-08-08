<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthInfo extends Model
{
    use SoftDeletes;
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
