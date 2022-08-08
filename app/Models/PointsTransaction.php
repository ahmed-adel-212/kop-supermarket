<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PointsTransaction extends Model
{
    use SoftDeletes;
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
