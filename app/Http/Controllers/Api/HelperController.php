<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Government;
use Illuminate\Http\Request;

class HelperController extends BaseController
{

    public function getCities() 
    {
        $cities = City::all();
        return $this->sendResponse($cities, __('general.ret', ['key' => __('general.city_ret')]));
    }

    public function getAreas(Request $request, int $city) 
    {
        $city = City::findOrFail($city);
        $city->loadMissing('areas');
        $areas = $city->areas;
        return $this->sendResponse($areas, 'area');
    }
    
    public function search(Request $request)
    {
        $search = ($request->input('q'))?$request->input('q'):"";
        $cities = City::where('name_'.app()->getLocale(), 'LIKE', '%'.$search.'%')->select(['id', 'name_ar', 'name_en'])
            ->get();
        return response()->json($cities);
    }

    public function getGovernments()
    {
        $govs = Government::all();

        return $this->sendResponse($govs, 'all governments restored');
    }

    public function getCitiesByGovernments(Request $request, int $government)
    {
        $government = Government::findOrFail($government);

        $government->load('cities');

        return $this->sendResponse($government->cities, 'all governments cities restored');
    }

    public function getGovernmentsWithAllCities(Request $request)
    {
        $govs = Government::with('cities.areas')->get();

        return $this->sendResponse($govs, 'all governments restored');
    }

}

