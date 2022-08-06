<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['subject', 'body', 'customer_id'];
    
    public function customer() {
        return $this->belongsTo('App\Models\User');
    }
}
