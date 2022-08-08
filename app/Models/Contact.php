<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $fillable = ['subject', 'body', 'customer_id'];
    
    public function customer() {
        return $this->belongsTo('App\Models\User');
    }
}
