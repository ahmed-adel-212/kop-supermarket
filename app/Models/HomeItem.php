<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeItem extends Model
{
    use SoftDeletes;
    protected $table = 'home_item';

    protected $fillable = [
        
        'item_id',
        'image',
        'category_id',
        'description_en',
        'description_ar',
        'number'
        
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }

}
