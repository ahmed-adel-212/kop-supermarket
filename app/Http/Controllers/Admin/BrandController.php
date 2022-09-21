<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\LogfileTrait;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    use LogfileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|min:3|max:20',
            'name_en' => 'required|min:3|max:20',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();

          $category = Brand::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'image' => '',
        ]);
        $this->Make_Log('App\Models\Category','create',$category->id);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('brands'), $image_new_name);
            $category->image = '/brands/' . $image_new_name;
            $category->save();
        }

        return redirect()->route('admin.brand.index')->with([
            'type' => 'success',
            'message' => 'brand insert successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('admin.brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
