<?php

namespace App\Http\Controllers\Api;

use App\Models\Careers;
use App\Models\JobRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use DB;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\HealthInfo;
use App\Models\Item;
use App\Models\News;
use App\Models\Offer;
use App\Models\OfferDiscount;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FrontController extends BaseController
{
    //aboutUS
    public function getAboutUS()
    {
        $aboutUS = AboutUs::first();
        return $this->sendResponse($aboutUS, __('general.ret', ['key' => __('general.about_ret')]));
    }

    //gallery
    public function getGallery()
    {
        $gallery = Gallery::paginate(12);
        return $this->sendResponse($gallery, __('general.ret', ['key' => __('general.gallery_ret')]));
    }

    //media Video
    public function getVideo($videoID = null)
    {
        $media = [];
        if ($videoID == null) {
            $all = Media::all();
            if (count($all) > 0) {
                $media['current'] = $all[0];
                //$media['allRemain'] = array_slice((array)$all, 1);
                $media['allRemain'] = $all;
            }
        } else {
            $media['current'] = Media::find($videoID);
            //$media['allRemain'] = Media::all()->except($videoID);
            $media['allRemain'] = Media::all();
        }
        return $this->sendResponse($media, __('general.ret', ['key' => __('general.media_ret')]));
    }

    //News
    public function getAllNews()
    {
        $news = News::paginate(6);
        return $this->sendResponse($news, __('general.ret', ['key' => __('general.news_ret')]));
    }
    public function getAllNewsNoPaginate()
    {
        $news = News::all();
        return $this->sendResponse($news, __('general.ret', ['key' => __('general.news_ret')]));
    }

    public function getNew($newID)
    {
        $new = News::find($newID);
        if ($new) {
            return $this->sendResponse($new, __('general.ret', ['key' => __('general.new_ret')]));
        }
        return $this->sendError(__('general.error'));
    }

    //Health Info
    public function getAllHealthInfo()
    {
        $healthInfo = HealthInfo::all();
        return $this->sendResponse($healthInfo,  __('general.ret', ['key' => __('general.health_ret')]));
    }

    //Jobs
    public function getAllJobs()
    {
        $careers = Careers::where('status', true)->get();
        return $this->sendResponse($careers,  __('general.ret', ['key' => __('general.carrers_ret')]));
    }

    public function GetJob($id)
    {
        $careers = Careers::find($id);

        return $this->sendResponse($careers,  __('general.ret', ['key' => __('general.carrer_ret')]));
    }

    public function jobRequest(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'cv_file' => 'required|mimes:pdf',

        ]);
        if ($validator->fails()) {
            return $this->sendError(__('general.validation_errors'), $validator->errors());
        }
        //check if application exist
        $countExist = JobRequest::where('id', $id)
            ->where(function ($q) use ($request) {
                $q->where('email', $request->email)
                    ->orWhere('phone', $request->phone);
            })->get()->count();
        if ($countExist > 0) {
            return $this->sendError(__('general.carrer_already'), __('general.app_not_sent'));
        }

        try {
            $jobRequest = new JobRequest();
            $jobRequest->job_id = $id;
            $jobRequest->name = $request->name;
            $jobRequest->email = $request->email;
            $jobRequest->phone = $request->phone;
            $jobRequest->description = $request->description;

            if ($request->hasFile('cv_file')) {
                $cv_file = $request->cv_file;
                $cv_file_new_name = time() . $cv_file->getClientOriginalName();
                $cv_file->move(public_path('CV'), $cv_file_new_name);
                $jobRequest->cv_file = '/CV/' . $cv_file_new_name;
            }
            $jobRequest->save();

            return $this->sendResponse($jobRequest, __('general.app_sent'));
        } catch (\Exception $ex) {
            return $this->sendError(__('general.validation_errors'), $validator->errors());
        }
    }

    public function getHomeSections()
    {
        $banner = Banner::all();

        // recommended items
        $new_arrival = Item::where('recommended', true)->get();

        // categories with items
        $categories = Category::where('category_id', null)->where('sub_category_id', null)->with('subCategories')->get();
        
        foreach ($categories as $cat) {
            $subCategoriesId = $cat->subCategories->pluck('id');
            $items = [];
            foreach ($cat->subCategories as $sub) {
                foreach ($sub->deepSubCategories as $deep) {
                    $item = $deep->items()->first();
                    if ($item !== null) {
                        $items[] = $item;
                    }
                }
            }
            $cat->items_data = $items;
        }

        $offers = DB::table('items')
            ->join('offer_discount_items', 'items.id', '=', 'offer_discount_items.item_id')
            ->join('offers', 'offers.id', '=', 'offer_discount_items.offer_id')
            ->join('offers_discount', 'offers_discount.offer_id', '=', 'offer_discount_items.offer_id')
            ->select('offers_discount.*', 'items.*')
            ->get();

        foreach ($offers as $item) {
            $item->has_offer = true;
            if ($item->discount_type == 1) {
                // percentage discount offer
                $item->offer_price = ((float)$item->price - ((float)$item->price * (float)$item->discount_value / 100));
            } else {
                // amount discount offer
                $item->offer_price = ((float)$item->price - (float)$item->discount_value);
            }
        }

        $return_policy = AboutUs::where('type', 'return')->first();
        $about_store = AboutUs::where('type', 'about')->first();

        $sizes = Size::all();
        $colors = Color::all();

        $cart_count = 0;
        if (Auth::check()) {
            foreach (Auth::user()->carts as $cart) {
                $cart_count += $cart->quantity;
            }
        }


        return $this->sendResponse(compact('banner', 'new_arrival', 'categories', 'offers', 'return_policy', 'about_store', 'sizes', 'colors', 'cart_count'), 'Get all menu items');
    }
}
