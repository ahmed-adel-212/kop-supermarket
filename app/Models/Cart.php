<?php

namespace App\Models;

use App\Models\Extra;
use Illuminate\Database\Eloquent\Model;
use App\Models\Without;
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
        'quantity',
        'offer_id',
        'offer_price'
    ];

    public $appends = [
        'extras_objects',
        'withouts_objects'
    ];

    public function item(){
        return $this->belongsTo('App\Models\Item');
    }

    public function getExtrasObjectsAttribute()
    {
        $objects = [];
        //return $objects= json_decode($this->attributes['extras']);
        if (isset($this->attributes['extras']) && $this->attributes['extras'] != 'null') {
            foreach (json_decode($this->attributes['extras']) as $extra) {
                $extra = Extra::find($extra);
                if ($extra) $objects[] = $extra;
            }
        }

        return $objects;
    }

    public function getWithoutsObjectsAttribute()
    {
        $objects = [];
        //return $objects = json_decode($this->attributes['withouts']);
        if (isset($this->attributes['withouts']) && $this->attributes['withouts'] != 'null') {
            foreach (json_decode($this->attributes['withouts']) as $without) {
                $without = Without::find($without);
                if ($without) $objects[] = $without;
            }
        }

        return $objects;
    }
}
