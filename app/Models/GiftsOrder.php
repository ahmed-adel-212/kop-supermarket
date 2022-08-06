<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftsOrder extends Model
{
    protected $fillable = [
        'user_id'
    ];
    
    public function gifts() {
        return $this->belongsToMany('App\Models\Gift', 'gifts_order_items', 'gifts_order_id', 'gift_id');
    }
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
