<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $galleries = Gallery::orderBy('id', 'DESC')->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title_ar' => ['required','unique:galleries,title_ar'],
            'title_en' => ['required','unique:galleries,title_en'],
            "url" => 'required|mimes:jpeg,png,jpg,gif,svg,tif,bmp,ico,psd,webp|dimensions:width=270,height=260',

        ]);
         try {
            $gallery = new Gallery();
            $gallery->title_ar = $request->title_ar;
            $gallery->title_en = $request->title_en;
            if ($request->hasFile('url'))
            {
                $image = $request->url;
                $image_new_name = time(). $image->getClientOriginalName();
                $image->move(public_path('gallery'), $image_new_name);
                $gallery->url = '/gallery/' . $image_new_name;
            }
            $gallery->save();

            return redirect()->route('admin.gallery.index')->with([
                'type' => 'success',
                'message' => 'New gallery Created successfuly'
            ]);
        }catch (\Exception $ex){
            return redirect()->route('admin.gallery.index')->with([
                'type' => 'error',
                'message' => 'There is something'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title_ar' => ['required','unique:galleries,title_ar,'.$request->id],
            'title_en' => ['required','unique:galleries,title_en,'.$request->id],
            "url" => 'nullable|mimes:jpeg,png,jpg,gif,svg,tif,bmp,ico,psd,webp',
        ]);
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->title_ar = $request->title_ar;
            $gallery->title_en = $request->title_en;
            if ($request->hasFile('url'))
            {
                $oldImage = $gallery->url;
                $image = $request->url;
                $image_new_name = time(). $image->getClientOriginalName();
                $image->move(public_path('gallery'), $image_new_name);
                $gallery->url = '/gallery/' . $image_new_name;
            }
            $gallery->save();
            if ($request->hasFile('url')){
                if(file_exists(public_path($oldImage))){
                    unlink(public_path($oldImage));
                }
            }

            return redirect()->route('admin.gallery.index')->with([
                'type' => 'success',
                'message' => 'New gallery updated successfuly'
            ]);
        }catch (\Exception $ex){
            return redirect()->route('admin.gallery.index')->with([
                'type' => 'error',
                'message' => 'There is something'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if(file_exists(public_path($gallery->url))){
            unlink(public_path($gallery->url));
        }
        $gallery->delete();
        return back();
    }
}
