<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;
    protected $table = 'order_item';

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'item_extras',
        'item_withouts',
        'dough_type_ar',
        'dough_type_en',
        'price',
        'offer_price',
        'offer_id',
        'offer_last_updated_at',
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    public function offer()
    {
        return $this->belongsTo('App\Models\Offer','offer_id');
    }

}
