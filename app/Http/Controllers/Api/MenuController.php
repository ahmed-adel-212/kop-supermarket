<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Http\Controllers\Api\BaseController;
use DB;
use App\Models\OfferDiscount;

class MenuController extends BaseController
{
    public function getAllCategories()
    {
        $categories = Category::all();
        // get first category items
        $items = $categories->first()->items()->simplePaginate();
        
        return $this->sendResponse(compact('categories', 'items'), 'All Categories retrieved successfully.');
    }

    public function getCategory(Request $request, Category $category)
    {
        $category = $category->with('items', 'extras', 'withouts')->find($category->id);

        foreach ($category->items as $key => $item) {
            $branches = explode(',', $item->branches);
            //if(in_array($request->branch_id, $branches))
            {
                $offers = DB::table('offer_discount_items')->where('item_id', $item->id)->get();

                $parent_offer = null;
                foreach ($offers as $offer) {
                    $parent_offer = OfferDiscount::find($offer->offer_id);


                    if ($parent_offer)  break;
                }

                if ($parent_offer) {

                    if (\Carbon\Carbon::now() < $parent_offer->offer->date_from || \Carbon\Carbon::now() > $parent_offer->offer->date_to) {
                        $parent_offer = null;
                    }
                }


                $item->offer = $parent_offer;

                if ($parent_offer) {
                    if ($parent_offer->discount_type == 1) {
                        $disccountValue = $item->price * $parent_offer->discount_value / 100;
                        $item->offer->offer_price = $item->price - $disccountValue;
                    } elseif ($parent_offer->discount_type == 2) {
                        $item->offer->offer_price = $item->price - $parent_offer->discount_value;
                    }

                    unset($item->offer->offer);
                }
            }
        }

        return $this->sendResponse($category, 'Categories retrieved successfully.');
    }

    public function getItems(Request $request, Category $category)
    {
        $items = $category->items()->with('category.extras', 'category.withouts')->get();

        foreach ($items as $key => $item) {
            $branches = explode(',', $item->branches);
            //if(in_array($request->branch_id, $branches))
            {
                $offers = DB::table('offer_discount_items')->where('item_id', $item->id)->get();

                $parent_offer = null;
                foreach ($offers as $offer) {
                    $parent_offer = OfferDiscount::find($offer->offer_id);

                    // Just edit
                    if ($parent_offer)  break;
                }

                if ($parent_offer) {

                    if (\Carbon\Carbon::now() < $parent_offer->offer->date_from || \Carbon\Carbon::now() > $parent_offer->offer->date_to) {
                        $parent_offer = null;
                    }
                }


                $item->offer = $parent_offer;

                if ($parent_offer) {
                    if ($parent_offer->discount_type == 1) {
                        $disccountValue = $item->price * $parent_offer->discount_value / 100;
                        $item->offer->offer_price = $item->price - $disccountValue;
                    } elseif ($parent_offer->discount_type == 2) {
                        $item->offer->offer_price = $item->price - $parent_offer->discount_value;
                    }

                    unset($item->offer->offer);
                }
            }
        }

        return $this->sendResponse($items, 'items retrieved successfully.');
    }

    public function getItem(Request $request, Item $item)
    {
        dd($item, 'test');
    }

    public function getExtras(Request $request, Category $category)
    {
        return $this->sendResponse($category->extras, 'Extras retrieved successfully.');
    }

    public function getWithouts(Request $request, Category $category)
    {
        return $this->sendResponse($category->withouts, 'Withouts retrieved successfully.');
    }

    public function getExtra(Request $request, Extra $extra)
    {
        dd($extra, 'test');
    }

    public function getWithout(Request $request, Without $without)
    {
        dd($without, 'test');
    }

    public function getOffers()
    {
    }

    public function getRecommendedItems(Request $request)
    {
        $items = Item::where('recommended', true)->simplePaginate();

        return $this->sendResponse($items, 'recommended items retrieved successfully.');
    }
}
