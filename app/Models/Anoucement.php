<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Anoucement extends Model
{
    use SoftDeletes;

    protected $table = "anoucement";
    protected $fillable = ['name_ar', 'name_en','description_ar', 'description_en', 'image'];

}
