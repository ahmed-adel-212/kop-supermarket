<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogFile extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'user_id',
        'model',
        'action',
        'action_id',
        'created_at',
        'updated_at',
     ];
}
