<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $table = 'payments';
    protected $fillable = [
        'id',
        'status',
        'message',
        'payment_id',
        'customer_id',
        'order_id',
        'total_paid',
        'data',
        'hash'
    ];
    public $timestamps = true;

    public function order()
    {
        $this->belongsTo(Order::class, 'order_id');
    }

}
