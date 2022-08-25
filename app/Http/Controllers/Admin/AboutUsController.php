<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\LogfileTrait;
class AboutUsController extends Controller
{
    const IMG_SIZES = [
        'emp' => [800, 1142],
        'with-bg' => [920, 1080],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use LogfileTrait;

    public function index(Request $request)
    {
        $aboutUS = AboutUs::get();
        $this->Make_Log('App\Models\AboutUS','view',0);
        return view('admin.aboutUS.index', compact('aboutUS'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aboutUS.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator_rules = ['title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'video' => 'nullable|mimes:mp4',
            'icon' => 'nullable|string',
            'type' => 'required|in:first,bg-st,feat,bg-nd,emp,with-bg',
            'links' => 'array',
            'links.*' => 'nullable|url',
        ];
        $validator = $request->validate($validator_rules);

       

        $img = null;
        if ($request->hasFile('image')) {
            $width = 600;
            $height = 400;
            if (isset(self::IMG_SIZES[$request->type])) {
                $width = self::IMG_SIZES[$request->type][0];
                $height = self::IMG_SIZES[$request->type][1];
            }
            $validator = Validator::make($request->all(), [
                'image' => "dimensions:width=$width,height=$height",
            ]); 
            if ($validator->fails()) {
                return back()->withErrors($validator->getMessageBag());
            }
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('aboutus'), $image_new_name);
            $img = '/aboutus/' . $image_new_name;
        }

        $vd = null;
        if ($request->hasFile('video')) {
            $video = $request->video;
            $video_new_name = time() . $video->getClientOriginalName();
            $video->move(public_path('aboutus'), $video_new_name);
            $vd = '/aboutus/' . $video_new_name;
        }

        $arr = $request->all();
        $arr['image'] = $img;
        $arr['video'] = $vd;
        
        $action=AboutUs::create($arr);
        $this->Make_Log('App\Models\AboutUS','create',$action->id);
        return redirect()->route('admin.aboutUS.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $about = AboutUs::findOrFail($id);
        return view('admin.aboutUS.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = AboutUs::findOrFail($id);

        return view('admin.aboutUS.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator_rules = ['title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'icon' => 'nullable|string',
            'type' => 'required|in:first,bg-st,feat,bg-nd,emp,with-bg',
            'links' => 'array',
            'links.*' => 'nullable|url',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'video' => 'nullable|mimes:mp4',
        ];
        $validator = $request->validate($validator_rules);
        $about = AboutUs::findOrFail($id);
        

        $img = $about->image;
        if ($request->hasFile('image')) {
            $width = 600;
            $height = 400;
            if (isset(self::IMG_SIZES[$about->type])) {
                $width = self::IMG_SIZES[$about->type][0];
                $height = self::IMG_SIZES[$about->type][1];
            }
            $validator = Validator::make($request->all(), [
                'image' => "dimensions:width=$width,height=$height",
            ]); 
            if ($validator->fails()) {
                return back()->withErrors($validator->getMessageBag());
            }
            $oldImage = $about->image;
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('aboutus'), $image_new_name);
            $img = '/aboutus/' . $image_new_name;
        }

        $vd = $about->video;
        if ($request->hasFile('video')) {
            $oldVideo = $about->video;
            $video = $request->video;
            $video_new_name = time() . $video->getClientOriginalName();
            $video->move(public_path('aboutus'), $video_new_name);
            $vd = '/aboutus/' . $video_new_name;
        }

        $about->fill($request->all());
        $about->image = $img;
        $about->video = $vd;

        $about->save();
        $this->Make_Log('App\Models\AboutUS','update',$id);

        if ($request->hasFile('video')) {
            if (file_exists(public_path($oldVideo))) {
                unlink(public_path($oldVideo));
            }
        }
        if ($request->hasFile('image')) {
            if (file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }
        }

        return redirect()->route('admin.aboutUS.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = AboutUs::findOrFail($id);
        $about->delete();
        $this->Make_Log('App\Models\AboutUS','delete',$id);
        return back();
    }
}
