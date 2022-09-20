<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Filters\SizeFilters;
use App\Models\Category;
use App\Traits\LogfileTrait;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use LogfileTrait;

    public function index(Request $request, SizeFilters $filters)
    {
        $sizes = Size::filter($filters)->withCount('items')->get();
        $this->Make_Log('App\Models\Size','view',0);
        return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sizes.create');
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
        ]);

        $Size = Size::create($validatedData);
        $this->Make_Log('App\Models\Size','create',$Size->id);

        if (!$Size)
            return redirect()->route('admin.size.index')->with([
                'type' => 'error',
                'message' => 'There is something wrong!!'
            ]);

        return redirect()->route('admin.size.index')->with([
            'type' => 'success',
            'message' => 'Menu Update successfuly'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Size $size)
    {
        return view('admin.sizes.show', compact('size'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {

        $validatedData = $request->validate([
            "name_ar" => 'required|string',
            "name_en" => 'required|string',
        ]);       

        if (!$size->update($validatedData))
            return redirect()->route('admin.size.index')->with([
                'type' => 'error',
                'message' => 'test'
            ]);
        $this->Make_Log('App\Models\Size','update',$size->id);
        return redirect()->route('admin.size.index')->with([
            'type' => 'success',
            'message' => 'Menu Update successfuly'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Size $size)
    {

        $size->delete();
        $this->Make_Log('App\Models\Size','delete',$size->id);
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Menu Size deleted successfuly'
        ]);

    }
}
