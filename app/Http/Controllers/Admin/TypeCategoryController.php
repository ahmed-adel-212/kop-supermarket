<?php

namespace App\Http\Controllers\Admin;

use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Extra;
use App\Models\DoughType;
use App\Traits\LogfileTrait;
use Illuminate\Support\Facades\Validator;

class TypeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use LogfileTrait;

    public function index()
    {
        $categories = Category::where('category_id', null)->where('sub_category_id', '!=', null)->withCount('items', 'parentSubCategory')->orderBy('id', 'DESC')->get();
        $this->Make_Log('App\Models\Category', 'view', 0);
        return view('admin.type_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('category_id', '!=', null)->where('sub_category_id', null)->get();

        return view('admin.type_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|min:3|max:20',
            'name_en' => 'required|min:3|max:20',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_parent' => 'nullable',
            'sub_category_id' => 'required|exists:categories,id',
            'shipping_details_ar' => 'nullable|array',
            'shipping_details_en' => 'nullable|array',
            'return_policy_ar' => 'nullable|string',
            'return_policy_en' => 'nullable|string',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();

        $shipping_en = collect($request->shipping_details_en);
        $shipping_en = ($shipping_en->filter(function ($x) {
            return $x !== null;
        }))->toArray();
        $shipping_ar = collect($request->shipping_details_ar);
        $shipping_ar = ($shipping_ar->filter(function ($x) {
            return $x !== null;
        }))->toArray();


        $type_category = Category::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'image' => '',
            'created_by' => auth()->id(),
            'sub_category_id' =>  $request->sub_category_id,
        ]);
        $this->Make_Log('App\Models\Category', 'create', $type_category->id);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('categories'), $image_new_name);
            $type_category->image = '/categories/' . $image_new_name;
            $type_category->save();
        }

        return redirect()->route('admin.type_category.index')->with([
            'type' => 'success',
            'message' => 'category insert successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $type_category)
    {
        $category = $type_category;

        return view('admin.type_category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $type_category)
    {

        // $doughTypes = DoughType::all();

        $categories = Category::where('category_id', '!=', null)->where('sub_category_id', null)->get();

        $category = $type_category;

        return view('admin.type_category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $type_category)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();

        if ($request->hasFile('image')) {
            if (File::exists(storage_path('app/public/' . $type_category->image))) {
                File::delete(storage_path('app/public/' . $type_category->image));
            }

            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('categories'), $image_new_name);
            $type_category->image = '/categories/' . $image_new_name;
            $type_category->save();
        }

        $type_category->name_ar = $request->name_ar;
        $type_category->name_en = $request->name_en;
        $type_category->description_ar = $request->description_ar;
        $type_category->description_en = $request->description_en;

        $type_category->sub_category_id = $request->sub_category_id;

        $type_category->updated_by = auth()->id();

        $type_category->return_policy_ar = $request->return_policy_ar;
        $type_category->return_policy_en = $request->return_policy_en;

        $shipping_en = collect($request->shipping_details_en);
        $shipping_en = ($shipping_en->filter(function ($x) {
            return $x !== null;
        }))->toArray();
        $shipping_ar = collect($request->shipping_details_ar);
        $shipping_ar = ($shipping_ar->filter(function ($x) {
            return $x !== null;
        }))->toArray();
        $type_category->shipping_details_en = $shipping_en;
        $type_category->shipping_details_ar = $shipping_ar;

        $type_category->save();

        // $this->Make_Log('App\Models\Category', 'update', $type_category->id);
 
        return redirect()->route('admin.type_category.index')->with([
            'type' => 'success',
            'message' => 'category Update successfuly'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $type_category)
    {
        $type_category->delete();
        // $this->Make_Log('App\Models\Category', 'delete', $type_category->id);
        return redirect()->route('admin.type_category.index')->with([
            'type' => 'error', 'message' => 'type category deleted successfuly'
        ]);
    }
}
