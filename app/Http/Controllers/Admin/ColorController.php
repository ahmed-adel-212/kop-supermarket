<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Filters\ColorFilters;
use App\Models\Category;
use App\Traits\LogfileTrait;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use LogfileTrait;

    public function index(Request $request, ColorFilters $filters)
    {
        $colors = Color::filter($filters)->withCount('items')->get();
        $this->Make_Log('App\Models\Color','view',0);
        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create');
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
            "name_ar" => 'required|string',
            "name_en" => 'required|string',
            'code' => 'required|string',
        ]);

        $validatedData['code'] = str_replace('#', '', $validatedData['code']);

        $Color = Color::create($validatedData);
        $this->Make_Log('App\Models\Color','create',$Color->id);

        if (!$Color)
            return redirect()->route('admin.color.index')->with([
                'type' => 'error',
                'message' => 'There is something wrong!!'
            ]);

        return redirect()->route('admin.color.index')->with([
            'type' => 'success',
            'message' => 'Color created successfuly'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Color $color)
    {
        return view('admin.colors.show', compact('color'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {

        $validatedData = $request->validate([
            "name_ar" => 'required|string',
            "name_en" => 'required|string',
            'code' => 'required|string',
        ]);

        $validatedData['code'] = str_replace('#', '', $validatedData['code']);

        if (!$color->update($validatedData))
            return redirect()->route('admin.color.index')->with([
                'type' => 'error',
                'message' => 'test'
            ]);
        $this->Make_Log('App\Models\Color','update',$color->id);
        return redirect()->route('admin.color.index')->with([
            'type' => 'success',
            'message' => 'Color Update successfuly'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Color $color)
    {

        $color->delete();
        $this->Make_Log('App\Models\Color','delete',$color->id);
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Menu Color deleted successfuly'
        ]);

    }
}
