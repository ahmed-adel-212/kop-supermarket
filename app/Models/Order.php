<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\QueryFilter;

class Order extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'customer_id',
        'branch_id',
        'service_type',
        'subtotal',
        'taxes',
        'delivery_fees',
        'total',
        'state',
        'cancellation_reason',
        'created_by',
        'updated_by',
        'address_id',
        'points_paid',
        'offer_type',
        'order_from'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address','address_id');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item', 'order_item')
            ->withPivot(['order_id', 'item_extras', 'item_withouts', 'dough_type_ar', 'dough_type_en', 'price', 'offer_price', 'quantity', 'offer_id']);
    }

    public function countOfItems()
    {
        return $this->items->count();
    }

    public function countOfExtras()
    {
        return $this->items->count();
    }

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
