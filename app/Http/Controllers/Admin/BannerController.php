<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Banner $banner)
    {
        $validatedData = $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image'))
        {
            $image = $request->image;
            $image_new_name = time(). $image->getClientOriginalName();
            $image->move(public_path('banners'), $image_new_name);
            $banner->image = '/banners/' . $image_new_name;
            $banner->save();
        }

        if (!$banner)
            return redirect()->route('admin.banner.index')->with([
                'type' => 'error',
                'message' => 'There is something'
            ]);

        return redirect()->route('admin.banner.index')->with([
            'type' => 'success',
            'message' => 'New Banner Created successfuly'
        ]);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Banner $banner)
    // {
    //     return view('admin.banners.show', compact('banner'));

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {

        $validatedData = $request->validate([
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image'))
        {
            $image = $request->image;
            $image_new_name = time(). $image->getClientOriginalName();
            $image->move(public_path('banners'), $image_new_name);
            $banner->image = '/banners/' . $image_new_name;
            $banner->save();
        }

        return redirect()->route('admin.banner.index')->with([
            'type' => 'success',
            'message' => 'Banner Updated successfuly'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Banner $banner)
    {

        $banner->delete();

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Banner deleted successfuly'
        ]);

    }
}
