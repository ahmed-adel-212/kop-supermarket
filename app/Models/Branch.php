<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $casts = ['service_type' => 'array', 'delivery_fees' => 'double'];


    protected function todayTimes() {
        return $this->workingDays()->where('day', strtolower(now()->englishDayOfWeek))->first();
    }

    public function cashiers()
    {
        return $this->hasMany('App\Models\User');
    }
    
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    
    
     public function cashiers2() {
        return $this->belongsToMany('App\Models\User', 'branch_user');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    public function area() {
        return $this->belongsTo('App\Models\Area');
    }

    public function deliveryAreas()
    {
    	return $this->belongsToMany('App\Models\Area', 'branch_delivery_areas');
    }

    public function workingDays()
    {
        return $this->hasMany('App\Models\BranchWorkingDay');
    }

    public function open() {
        return optional($this->todayTimes())->time_from;
    }

    public function close() {
        return optional($this->todayTimes())->time_to;
    }
}
