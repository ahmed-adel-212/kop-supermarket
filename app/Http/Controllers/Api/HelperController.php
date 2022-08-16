<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;

class HelperController extends BaseController
{

    public function getCities() 
    {
        $cities = City::all();
        return $this->sendResponse($cities, 'test');
    }

    public function getAreas(Request $request, int $city) 
    {
        $city = City::findOrFail($city);
        $city->loadMissing('areas');
        $areas = $city->areas;
        return $areas;
    }
    
    public function search(Request $request)
    {
        $search = ($request->input('q'))?$request->input('q'):"";
        $cities = City::where('name_'.app()->getLocale(), 'LIKE', '%'.$search.'%')->select(['id', 'name_ar', 'name_en'])
            ->get();
        return response()->json($cities);
    }

}

