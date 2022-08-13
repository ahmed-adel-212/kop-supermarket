<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General;
use App\Traits\LogfileTrait;
use Illuminate\Http\Request;

class PointController extends Controller
{
    use LogfileTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('www');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.points.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'value' => 'required|numeric|min:0',
            'for' => 'required|numeric|min:0'
        ]);

        $value = General::create([
            'value' => $request->value,
            'for' => $attributes['for'],
            'key' => 'pointsValue',
        ]);
        $this->Make_Log('App\Models\General','update',$value->id);
        return redirect()->route('admin.pointsValue')->with([
            'type' => 'success',
            'message' => 'Value Updated Successfuly'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $point)
    {
        $point = General::findOrFail($point);
        return view('admin.points.edit', compact('point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $point)
    {
        $attributes = $request->validate([
            'value' => 'required|numeric|min:0',
            'for' => 'required|numeric|min:0'
        ]);

        $point = General::findOrFail($point);
        $point->value = $request->value;
        $point->for = $attributes['for'];

        $value = $point->save();
        $value = $point;
        $this->Make_Log('App\Models\General','update',$value->id);
        return redirect()->route('admin.pointsValue')->with([
            'type' => 'success',
            'message' => 'Value Updated Successfuly'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $point)
    {
        $point = General::findOrFail($point);

        $point->delete();

        return redirect()->route('admin.pointsValue')->with([
            'type' => 'success',
            'message' => 'Value Deleted Successfuly'
        ]);
    }
}
