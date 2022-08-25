<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Messages extends Model
{
    use SoftDeletes; 
    protected $table ='message';
    protected $fillable = [
        'id', 
        'subject',
        'description',
        'user_id',
        'created_at',
        'updated_at',
     ];
     public function user()
     {
         return $this->belongsTo('App\Models\User', 'user_id');
     }
 
}