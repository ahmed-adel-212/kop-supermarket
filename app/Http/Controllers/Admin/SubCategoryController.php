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

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use LogfileTrait;

    public function index()
    {
        $categories = Category::where('category_id', '!=', null)->where('sub_category_id', null)->withCount('items', 'deepSubCategories', 'parent')->orderBy('id', 'DESC')->get();
        $this->Make_Log('App\Models\Category', 'view', 0);
        return view('admin.sub_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doughTypes = DoughType::all();
        $categories = Category::all();
        return view('admin.sub_category.create', compact('doughTypes', 'categories', 'is_parent'));
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
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'is_parent' => 'nullable',
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


        $sub_category = Category::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'image' => '',
            'created_by' => auth()->id(),
            'dough_type_id' =>  $request->has('dough_type_id') ? $request->dough_type_id : null,
            'dough_type_2_id' => $request->has('dough_type_2_id') ? $request->dough_type_2_id : null,
            'category_id' => $request->category_id,
            'return_policy_ar' => $request->return_policy_ar,
            'return_policy_en' => $request->return_policy_en,
            'shipping_details_en' => $shipping_en,
            'shipping_details_ar' => $shipping_ar,
        ]);
        $this->Make_Log('App\Models\Category', 'create', $sub_category->id);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('categories'), $image_new_name);
            $sub_category->image = '/categories/' . $image_new_name;
            $sub_category->save();
        }

        return redirect()->route('admin.sub_category.index')->with([
            'type' => 'success',
            'message' => 'sub_category insert successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $sub_category)
    {
        $category = $sub_category;
        return view('admin.sub_category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $sub_category)
    {

        // $doughTypes = DoughType::all();
        $category = $sub_category;


        $categories = Category::all();

        return view('admin.sub_category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $sub_category)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dough_type_id' => 'nullable',
            'dough_type_2_id' => 'nullable',
            // 'is_parent' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'shipping_details_ar' => 'nullable|array',
            'shipping_details_en' => 'nullable|array',
            'return_policy_ar' => 'nullable|string',
            'return_policy_en' => 'nullable|string',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();

        if ($request->hasFile('image')) {
            if (File::exists(storage_path('app/public/' . $sub_category->image))) {
                File::delete(storage_path('app/public/' . $sub_category->image));
            }

            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('categories'), $image_new_name);
            $sub_category->image = '/categories/' . $image_new_name;
            $sub_category->save();
        }

        $sub_category->name_ar = $request->name_ar;
        $sub_category->name_en = $request->name_en;
        $sub_category->description_ar = $request->description_ar;
        $sub_category->description_en = $request->description_en;

        $sub_category->category_id = $request->category_id;

        $sub_category->updated_by = auth()->id();

        // $sub_category->dough_type_id =  $request->has('dough_type_id') ? $request->dough_type_id : null;
        // $sub_category->dough_type_2_id = $request->has('dough_type_2_id') ? $request->dough_type_2_id : null;

        $sub_category->return_policy_ar = $request->return_policy_ar;
        $sub_category->return_policy_en = $request->return_policy_en;

        $shipping_en = collect($request->shipping_details_en);
        $shipping_en = ($shipping_en->filter(function ($x) {
            return $x !== null;
        }))->toArray();
        $shipping_ar = collect($request->shipping_details_ar);
        $shipping_ar = ($shipping_ar->filter(function ($x) {
            return $x !== null;
        }))->toArray();
        $sub_category->shipping_details_en = $shipping_en;
        $sub_category->shipping_details_ar = $shipping_ar;

        $sub_category->save();

        // if ($request->dough_type_id) {
        //     $sub_category->dough_type_id = (int)$request->dough_type_id;
        //     $sub_category->save();
        // } else {
        //     $sub_category->dough_type_id = null;
        //     $sub_category->save();
        // }

        $this->Make_Log('App\Models\Category', 'update', $sub_category->id);
        if ($request->has('Item'))
            $sub_category->items()->updateOrCreate($request->Item);
        // {
        //     $items = Item::where(['sub_category_id' => $sub_category->id])->get();

        //     $items = $sub_category->items;
        //     $items->each->delete();
        //     $new_items = $request->get('Item');
        //     foreach ($new_items as $item) {
        //         $item = Item::create([
        //             'sub_category_id' => $sub_category->id,
        //             'name_ar' => $item['name_ar'],
        //             'name_en' => $item['name_en'],
        //             'description_ar' => $item['description_ar'],
        //             'description_en' => $item['description_en'],
        //             'price' => $item['price'],
        //             'calories' => $item['calories'],
        //         ]);
        //     }
        // }
        if ($request->has('Extra'))
            $sub_category->extras()->updateOrCreate($request->Extra);
        // {
        //     $extras = $sub_category->extras;
        //     $extras->each->delete();
        //     $new_extras = $request->get('Extra');
        //     foreach ($new_extras as $extra) {
        //         // $extra['image'] = $request->file('image')->store('extras', 'public');
        //         $extra = Extra::create([
        //             'name_ar' => $extra['name_ar'],
        //             'name_en' => $extra['name_en'],
        //             // 'description_ar' => $extra['description_ar'],
        //             // 'description_en' => $extra['description_en'],
        //             'price' => $extra['price'],
        //             'calories' => $extra['calories'],
        //             'sub_category_id' => $sub_category->id,

        //         ]);
        //     }
        // }

        return redirect()->route('admin.sub_category.index')->with([
            'type' => 'success',
            'message' => 'sub_category Update successfuly'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $sub_category)
    {
        $sub_category->delete();
        $this->Make_Log('App\Models\Category', 'delete', $sub_category->id);
        return redirect()->route('admin.sub_category.index')->with([
            'type' => 'error', 'message' => 'sub_category deleted successfuly'
        ]);
    }
}
