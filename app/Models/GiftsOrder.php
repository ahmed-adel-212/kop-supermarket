<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiftsOrder extends Model
{
    use SoftDeletes;
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
