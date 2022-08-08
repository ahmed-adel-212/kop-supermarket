<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiftsOrderItem extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'gifts_order_id',
        'gift_id',
        'quantity'
    ];
}
