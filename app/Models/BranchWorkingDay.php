<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchWorkingDay extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    // TODO: craete function return open time

    // TODO: craete function return close time

}
