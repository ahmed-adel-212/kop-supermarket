<?php

namespace App\Http\Controllers\Admin;

use App\Models\Anoucement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\LogfileTrait;
class AnoucementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use LogfileTrait;

    public function index(Request $request)
    {
        $Anoucement = Anoucement::get();
        $this->Make_Log('App\Models\Anoucement','view',0);
        return view('admin.Anoucement.index', compact('Anoucement'));
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
        $validator_rules = ['name_ar' => 'required',
            'name_en' => 'required',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
        
        ];
        $validator = $request->validate($validator_rules);

        $img = null;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('Anoucement'), $image_new_name);
            $img = '/Anoucement/' . $image_new_name;
        }

       
        $arr = $request->all();
        $arr['image'] = $img;
        $action=Anoucement::create($arr);
        $this->Make_Log('App\Models\Anoucement','create',$action->id);
        return redirect()->route('admin.Anoucement.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
 
    public function edit($id)
    {
        $Anoucement = Anoucement::findOrFail($id);

        return view('admin.Anoucement.edit', compact('Anoucement'));
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
        $validator_rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $validator = $request->validate($validator_rules);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('Anoucement'), $image_new_name);
            $validator['image'] = '/Anoucement/' . $image_new_name;
        }
        
        $Anoucement = Anoucement::findOrFail($id);
        $Anoucement->fill($validator);
        $Anoucement->save();
        $this->Make_Log('App\Models\Anoucement','update',$id);
        return redirect()->route('admin.Anoucement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = Anoucement::findOrFail($id);
        $about->update(
            [
            'name_ar'   =>null,
            'name_en'   =>null,
            'description_ar' =>null,
            'description_en'=>null,
            'image' =>null
        ]);
        $this->Make_Log('App\Models\Anoucement','delete',$id);
        return back();
    }
}
