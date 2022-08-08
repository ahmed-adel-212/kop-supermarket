<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\LogfileTrait;
class AboutUsController extends Controller
{
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
            'description_ar' => 'required',
            'description_en' => 'required'];
        $validator = $request->validate($validator_rules);
        $action=AboutUs::create($request->all());
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
            'description_en' => 'required'];
        $validator = $request->validate($validator_rules);
        $about = AboutUs::findOrFail($id);
        $about->update($request->all());
        $this->Make_Log('App\Models\AboutUS','update',$id);
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
