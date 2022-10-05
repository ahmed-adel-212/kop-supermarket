<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\QueryFilter;
use App\Models\Category;
use App\Models\DoughType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = ['branches', 'name_ar', 'name_en', 'price', 'calories', 'category_id', 'description_ar', 'description_en', 'image', 'website_image', 'brand_id'];

    protected $hidden = ["calories", 'branches', 'website_image'];

    protected $appends = [
        'favoured', 'price_without_tax',
        'offer_price_without_tax', 'offer_price', 'has_offer', 'offer'
    ];

    protected $with = ['sizes', 'colors'];

    protected $casts = ['main' => 'boolean', 'price' => 'double', 'price_without_tax' => 'double', 'offer_price_without_tax' => 'double', 'offer_price_2' => 'float'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'item_size');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'item_color')->withPivot(['image']);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
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
            return true;
        }

        return $this->isHiddenByBranch(request('branch_id', 0));
    }

    public function isHiddenByBranch($branchId)
    {
        if (empty($this->branches)) {
            return true;
        }
        $branches = explode(',', $this->branches);
        $target_branch = Branch::find($branchId);
        if ($target_branch) {
            foreach ($branches as $branch_id) {
                if ($target_branch->id == $branch_id) {
                    return false;
                }
            }
        }

        return true;
    }

    public function getDoughTypeAttribute()
    {
        // $category = Category::where('id', $this->category_id)->first();
        $category = Category::find($this->category_id);
        if (!$category || null === $category->dough_type_id) {
            return [];
        }
        $dough_type_id = $category->dough_type_id;
        $dough_type = DoughType::where('dough_type_id', $dough_type_id)->select('name_ar', 'name_en')->get();

        return $dough_type;
    }

    public function getDoughType2Attribute()
    {
        // $category = Category::where('id', $this->category_id)->first();
        $category = Category::find($this->category_id);
        if (!$category || null === $category->dough_type_2_id) {
            return [];
        }
        $dough_type_id = $category->dough_type_2_id;
        $dough_type = DoughType::where('dough_type_id', $dough_type_id)->select('name_ar', 'name_en')->get();

        return $dough_type;
    }

    public function getFavouredAttribute()
    {
        if (!Auth::check()) {
            return false;
        }

        return DB::table('favourite_item')->where('user_id', Auth::id())->where('item_id', $this->id)->exists();
    }

    public function getPriceWithoutTaxAttribute()
    {
        return (string)round($this->price / 1.15, 2);
    }

    public function getOfferPriceWithoutTaxAttribute()
    {
        if (!$this->offer || !$this->offer_price) {
            return null;
        }
        return round($this->offer_price / 1.15);
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

    /**
     * define favourite items to users relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favourites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourite_item');
    }

    public function favouritesCount(): int
    {
        return $this->favourites()->count();
    }

    public function favouredBy(User $user)
    {
        $this->favourites()->attach($user);
    }

    public function unFavouredBy(User $user)
    {
        $this->favourites()->detach($user);
    }

    public function isFavouredBy(User $user): bool
    {
        return $this->favourites()->where('user_id', $user->id)->exists();
    }

    public function getOfferAttribute()
    {
        $offer = OfferDiscount::find(optional(DB::table('offer_discount_items')->where('item_id', $this->id)->first())->offer_id);
        if (!$offer) return null;

        $today = \Carbon\Carbon::now();
        $dateFrom = $offer->offer->date_from;
        $dateTo = $offer->offer->date_to;

        if ($today->gt($dateFrom) && $today->lt($dateTo)) {
            unset($offer->offer);
            return $offer;
        }

        return null;
    }

    public function getHasOfferAttribute()
    {
        if (!$this->offer) return false;

        return true;
    }

    public function getOfferPriceAttribute()
    {
        if (!$this->has_offer) {
            return null;
        }

        $offerPrice = 0;

        if ($this->offer->discount_type == 1) {

            $disccountValue = $this->price * $this->offer->discount_value / 100;
            $this->offer->offer_price = $this->price - $disccountValue;
            $offerPrice = $this->price - $disccountValue;
        } elseif ($this->offer->discount_type == 2) {
            $this->offer->offer_price = $this->price - $this->offer->discount_value;
            $offerPrice = $this->price - $this->offer->discount_value;
        }
        return $offerPrice;
    }
}
