<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

     protected $fillable = [
         'name', 'street', 'building_number', 'floor_number','landmark','city_id','customer_id','area_id'
     ];

    protected $guarded = [];

    public function customer()
    {
    	return $this->belongsTo('App\Models\user');
    }

    public function city() {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function area() {
        return $this->belongsTo('App\Models\Area','area_id');
    }
    public function orders() {
        return $this->hasMany(Order::class,'address_id','id');
    }

}
