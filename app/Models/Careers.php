<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Careers extends Model
{
    protected $table='jobs';
    protected $fillable = [
        'id',
        'title_ar',
        'title_en',
        'description_ar'
        ,'description_en',
        'status',
        'brief_description_ar',
        'brief_description_en',
        'responsibilities_ar',
        'responsibilities_en',
        'created_at',
        'updated_at',
    ];
    public function job_requests(){
        return $this->hasMany(JobRequest::class,'job_id');
    }
    public function getStatus()
    {
        return $this->status == 1 ? 'Active' : 'InActive';

    }
}
