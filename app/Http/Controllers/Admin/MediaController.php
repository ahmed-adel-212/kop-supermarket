<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medias = Media::orderBy('id', 'DESC')->get();
        return view('admin.media.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
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
            'title_ar' => ['required','string','unique:media,title_ar'],
            'title_en' => ['required','string','unique:media,title_en'],
            'author' => ['required','string'],
            "url" => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm,flv,wmv',
        ]);
        try {
            $media = new Media();
            $media->title_ar = $request->title_ar;
            $media->title_en = $request->title_en;
            $media->author = $request->author;
            if ($request->hasFile('url'))
            {
                $video = $request->url;
                $video_new_name = time(). $video->getClientOriginalName();
                $video->move(public_path('media'), $video_new_name);
                $media->url = '/media/' . $video_new_name;
            }
            $media->save();

            return redirect()->route('admin.media.index')->with([
                'type' => 'success',
                'message' => 'New Media Created successfuly'
            ]);
        }catch (\Exception $ex){
            return redirect()->route('admin.media.index')->with([
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
    public function show($id)
    {
        $media = Media::findOrFail($id);
        return view('admin.media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = Media::findOrFail($id);
        return view('admin.media.edit', compact('media'));
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
            'title_ar' => ['required','unique:media,title_ar,'.$request->id],
            'title_en' => ['required','unique:media,title_en,'.$request->id],
            'author' => ['required'],
            "url" => 'mimes:mp4,ogx,oga,ogv,ogg,webm,flv,wmv',
        ]);
        try {
            $media = Media::findOrFail($id);
            $media->title_ar = $request->title_ar;
            $media->title_en = $request->title_en;
            $media->author = $request->author;
            if ($request->hasFile('url'))
            {
                $oldVideo = $media->url;
                $video = $request->url;
                $video_new_name = time(). $video->getClientOriginalName();
                $video->move(public_path('media'), $video_new_name);
                $media->url = '/media/' . $video_new_name;
            }
            $media->save();
            if ($request->hasFile('url')){
                if(file_exists(public_path($oldVideo))){
                    unlink(public_path($oldVideo));
                }
            }

            return redirect()->route('admin.media.index')->with([
                'type' => 'success',
                'message' => 'New media updated successfuly'
            ]);
        }catch (\Exception $ex){
            return redirect()->route('admin.media.index')->with([
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
        $media = Media::findOrFail($id);
        if(file_exists(public_path($media->url))){
            unlink(public_path($media->url));
        }
        $media->delete();
        return back();
    }
}
