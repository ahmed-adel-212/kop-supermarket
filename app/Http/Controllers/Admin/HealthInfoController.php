<?php

namespace App\Http\Controllers\Admin;

use App\Models\HealthInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Traits\LogfileTrait;

class HealthInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use LogfileTrait;

    public function index()
    {
        $infos = HealthInfo::orderBy('id', 'DESC')->get();
        $this->Make_Log('App\Models\HealthInfo', 'view', 0);
        return view('admin.health.index', compact('infos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.health.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validationRules = [
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|dimensions:width=1000,height=650',
        ];


        $attributes = $request->validate($validationRules);

        $img = null;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('health_infos'), $image_new_name);
            $img = '/health_infos/' . $image_new_name;
        }

        $job = HealthInfo::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'image' => $img,
            'created_at' => Carbon::now(),
        ]);
        $this->Make_Log('App\Models\HealthInfo', 'create', $job->id);

        return redirect()->route('admin.healthinfo.index')->with([
            'type' => 'success',
            'message' => 'Blog insert successfuly'
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
        $info = HealthInfo::find($id);
        return view('admin.health.show', compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = HealthInfo::find($id);
        return view('admin.health.edit', compact('info'));
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
        $attributes = $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|dimensions:width=1000,height=650',

        ]);

        $hinfo = HealthInfo::findOrFail($id);

        $img = $hinfo->image;
        if ($request->hasFile('image')) {
            $oldImage = $hinfo->image;
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('health_infos'), $image_new_name);
            $img = '/health_infos/' . $image_new_name;

            if (file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }
        }

        $hinfo->fill([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'image' => $img,
        ]);
        $hinfo->save();
        $this->Make_Log('App\Models\HealthInfo', 'update', $id);
        return redirect()->route('admin.healthinfo.index')->with([
            'type' => 'success',
            'message' => 'Blog Update successfuly'
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
        $hinfo = HealthInfo::findOrFail($id);
        if (file_exists(public_path($hinfo->image))) {
            unlink(public_path($hinfo->image));
        }
        $hinfo->delete();
        $this->Make_Log('App\Models\HealthInfo', 'delete', $id);
        return redirect()->route('admin.healthinfo.index')->with([
            'type' => 'success', 'message' => 'Blog deleted successfuly'
        ]);
    }
}
