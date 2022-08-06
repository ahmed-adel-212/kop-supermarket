<?php

namespace App\Http\Controllers\Admin;

use App\Models\HealthInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $infos = HealthInfo::orderBy('id', 'DESC')->get();

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

        ];


        $attributes = $request->validate($validationRules);

        $job = HealthInfo::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,

            'created_at' => Carbon::now(),
        ]);


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

        ]);
        HealthInfo::where('id', $id)
            ->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,

            ]);

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
        HealthInfo::find($id)->delete();
        return redirect()->route('admin.healthinfo.index')->with([
            'type' => 'success', 'message' => 'Blog deleted successfuly'
        ]);
    }
}
