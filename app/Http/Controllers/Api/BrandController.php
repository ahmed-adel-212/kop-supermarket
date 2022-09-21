<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\GeneralTrait;

class BrandController extends BaseController
{
    public function index()
    {
        $brands = Brand::withCount('items')->get();

        return $this->sendResponse($brands, 'all brands list');
    }

    public function show(Request $request, $brand)
    {
        $brand = Brand::findOrFail($brand);

        $brand->loadMissing('items');

        return $this->sendResponse($brand, 'brand with items');
    }
}
