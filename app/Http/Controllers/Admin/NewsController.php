<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\LogfileTrait;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
           
    use LogfileTrait;

    public function index()
    {
        $news = News::orderBy('id', 'DESC')->get();
        $this->Make_Log('App\Models\News','view',0);
        return view('admin.News.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.News.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validationRules = [
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            "image" => 'required|mimes:jpeg,png,jpg',
            // "image" => 'required|mimes:jpeg,png,jpg|dimensions:width=1000,height=650',

        ];

        $attributes = $request->validate($validationRules);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('/blogs'), $image_new_name);
            $file_path = '/blogs/' . $image_new_name;
        }
        $job = News::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'author' => auth()->user()->name,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'image' => $file_path,
            'created_at' => Carbon::now(),
        ]);

        $this->Make_Log('App\Models\News','create',$job->id);
        return redirect()->route('admin.news.index')->with([
            'type' => 'success',
            'message' => 'Blog insert successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = News::find($id);
        return view('admin.News.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = News::find($id);
        return view('admin.News.edit', compact('blog'));
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
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            "image" => 'required|mimes:jpeg,png,jpg',
            // "image" => 'required|mimes:jpeg,png,jpg|dimensions:width=1000,height=650',
         ]);


        $blog = News::findOrFail($id);
        $blog->title_ar = $request->title_ar;
        $blog->title_en = $request->title_en;
        $blog->description_ar = $request->description_ar;
        $blog->description_en = $request->description_en;
//        $blog->author = $request->author;

        if ($request->hasFile('image')) {
            $oldImage = $blog->image;
            $image = $request->image;
            $NewImageName = time() . $image->getClientOriginalName();
            $image->move(public_path('blogs'), $NewImageName);
            $blog->image = '/blogs/' . $NewImageName;

            if (file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }
        }
        $blog->save();

        $this->Make_Log('App\Models\News','update',$id);
        return redirect()->route('admin.news.index')->with([
            'type' => 'success',
            'message' => 'Blog News successfuly'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $blog = News::findOrFail($id);

        if(file_exists(public_path($blog->image))){
            unlink(public_path($blog->image));
        }
//        unlink($blog->image); //delete from folder

        $blog->delete();
        $this->Make_Log('App\Models\News','delete',$id);
        return redirect()->back()->with([
            'type' => 'error', 'message' => 'Blog  deleted successfuly'
        ]);
    }
}
