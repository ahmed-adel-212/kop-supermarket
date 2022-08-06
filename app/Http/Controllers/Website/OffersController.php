<?php

namespace App\Http\Controllers\Website;

use App\Filters\OfferFilters;
use App\Models\Offer;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OffersController extends Controller
{
    public function get_offers()
    {
        $request = new \Illuminate\Http\Request();
        //$request->merge(['branch' => session()->get('branch_id')]);
        $request->merge(['type' => session()->get('service_type')]);
        $request->merge(['now' => Carbon::now()]);
        $filters = new OfferFilters($request);

        $return = (app(\App\Http\Controllers\Api\OffersController::class)->index($request, $filters))->getOriginalContent();

        if ($return['success'] == 'success') {
             $offers = $return['data'];
        }
        return view('website.offers', compact(['offers']));
    }

    public function offerItems($offerID)
    {
        $request = new \Illuminate\Http\Request();
        $offer = Offer::find($offerID);
        $return = (app(\App\Http\Controllers\Api\OffersController::class)->get($request, $offer))->getOriginalContent();
        $offers = $return['data'];
        if ($offer->offer_type == 'discount') {
            return view('website.offerDiscount', compact(['offers']));
        }
        return view('website.offerBuyGet', compact(['offers']));
    }
}
