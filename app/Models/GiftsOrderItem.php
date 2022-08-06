<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftsOrderItem extends Model
{
    protected $fillable = [
        'gifts_order_id',
        'gift_id',
        'quantity'
    ];
}
