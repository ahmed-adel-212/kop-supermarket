<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'id',
        'status',
        'message',
        'payment_id',
        'customer_id',
        'order_id',
        'total_paid'
    ];
    public $timestamps = true;

    public function order()
    {
        $this->belongsTo(Order::class, 'order_id');
    }

}
