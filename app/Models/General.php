<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General extends Model
{
    use SoftDeletes;
    protected $table = 'general';
    protected $fillable = [
        'id',
        'key',
        'value',
        'for',
    ];
    public $timestamps = false;

    public $appends = ['points'];

    public function getPointsAttribute()
    {
        return isset($this->for) ? $this->for : 0;
    }
}
