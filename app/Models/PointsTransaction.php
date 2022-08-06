<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsTransaction extends Model
{
    protected $fillable = [
        'points',
        'user_id',
        'order_id',
        'status'
    ];
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
