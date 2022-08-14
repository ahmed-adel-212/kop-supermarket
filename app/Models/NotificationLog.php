<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationLog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'chat_id',
        'body',
        'data',
        'type',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
