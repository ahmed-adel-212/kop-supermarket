<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\QueryFilter;
use App\Models\Category;
use App\Models\DoughType;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $fillable = ['name_ar', 'name_en', 'price', 'calories', 'category_id', 'description_ar', 'description_en', 'image'];

    protected $hidden = ["branches"];
    protected $appends = ['is_hidden', 'dough_type'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function extras()
    {
        return $this->belongsToMany('App\Models\Extra');
    }

    public function withouts()
    {
        return $this->belongsToMany('App\Models\Without');
    }

    public function order()
    {
        return $this->belongsToMany('App\Models\Order', 'order_item');
    }

    public function getIsHiddenAttribute()
    {
        if (!request()->has('branch_id')) {
            return false;
        }

        return $this->isHiddenByBranch(request('branch_id', 0));
    }

    public function isHiddenByBranch($branchId)
    {
        if (empty($this->branches)) {
            return false;
        }
        $branches = explode(',', $this->branches);
        $target_branch = Branch::find($branchId);
        if ($target_branch) {
            foreach ($branches as $branch_id) {
                if ($target_branch->id == $branch_id) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getDoughTypeAttribute()
    {
        $category = Category::where('id', $this->category_id)->first();
        $dough_type_id = $category->dough_type_id;
        $dough_type = DoughType::where('dough_type_id', $dough_type_id)->select('name_ar', 'name_en')->get();

        return $dough_type;
    }

    public function isVisibleForAuthUser()
    {
        $authUser = auth()->user();
        $hasAdminRole = $authUser->hasRole('admin');
        $userBranches = $authUser->branches;

        dd($hasAdminRole, $userBranches);

        // if ($target_branch) {
        //     foreach ($branches as $branch_id) {
        //         if ($target_branch->id == $branch_id) {
        //             return true;
        //         }
        //     }
        // }

        // return false;
    }

    public function getImageAttribute($value)
    {
        if (!empty($value) && file_exists(public_path($value))) {
            return url($value);
        } else {
            return 'http://via.placeholder.com/200x200?text=No+Image';
        }
    }


    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
