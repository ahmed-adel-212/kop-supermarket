<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferDiscount extends Model
{
    protected $guarded = [];

    protected $table = 'offers_discount';

    public function offer()
    {
    	return $this->belongsTo('App\Models\Offer');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function items() {
        return $this->belongsToMany('App\Models\Item', 'offer_discount_items', 'offer_id', 'item_id');
    }


}
