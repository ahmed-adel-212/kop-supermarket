<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    public function branch(){
        return $this->belongsToMany("App\Models\branch", 'branch_delivery_areas');
    }

    public function coveredBy() {
        return $this->belongsToMany('App\Models\Branch', 'branch_delivery_areas');
    }
}
