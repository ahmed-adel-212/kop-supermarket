<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoughType extends Model
{
    use SoftDeletes;
    protected $fillable = ['dough_type_id', 'name_ar', 'name_en'];
}
