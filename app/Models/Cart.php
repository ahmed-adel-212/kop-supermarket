<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'item_id',
        'extras',
        'withouts',
        'dough_type_ar',
        'dough_type_en',
        'size_id',
        'color_id',
        'quantity',
        'offer_id',
        'offer_price'
    ];

    public $appends = [
        'price',
    ];

    protected $hidden = [
        'extras',
        'withouts',
        'dough_type_ar',
        'dough_type_en',
    ];

    protected $casts = [
        'size_id' => 'int',
        'color_id' => 'int',
        'quantity' => 'int',
        'item_id' => 'int',
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function getPriceAttribute()
    {
        $itemPrice = $this->offer_id ? $this->offer_price : 0;
        if (isset($this->item)) {
            $itemPrice = $this->offer_id ? $this->offer_price : $this->item->price;
        }

        if (isset($this->extras_objects)) {
            return $itemPrice + collect($this->extras_objects)->sum('price');
        }

        return $itemPrice;
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
