<?php
namespace App\Http\Controllers\Admin;

use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Extra;
use App\Models\DoughType;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('items')->orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doughTypes = DoughType::all();
        return view('admin.category.create', compact('doughTypes'));
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
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();

//        $item_validation_rules = [
//            'Item.*.name_ar' => 'required|string',
//            'Item.*.name_en' => 'required|string',
//            'Item.*.description_ar' => 'required|string',
//            'Item.*.description_en' => 'required|string',
//            'Item.*.price' => 'required|numeric',
//            'Item.*.calories' => 'required|numeric',
//            'Item.*.image' => 'required|image',
//        ];
//        $extra_validation_rules = [
//            'Extra.*.name_ar' => 'required|string',
//            'Extra.*.name_en' => 'required|string',
//            'Extra.*.price' => 'required|numeric',
//            'Extra.*.calories' => 'required|numeric',
//            'Extra.*.image' => 'required|image'
//        ];
//        if ($request->has('Item'))
//            $validationRules = array_merge($validationRules, $item_validation_rules);
//
//        if ($request->has('Extra'))
//            $validationRules = array_merge($validationRules, $extra_validation_rules);
//          $attributes = $request->validate($validationRules);

          $category = Category::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'image' => '',
            'created_by' => auth()->id()
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('categories'), $image_new_name);
            $category->image = '/categories/' . $image_new_name;
            $category->save();
        }

//        if ($request->has('Item')) {
//            $items = $request->get('Item');
//            foreach ($items as $item) {
//                $item = Item::create([
//                    'category_id' => $category->id,
//                    'name_ar' => $item['name_ar'],
//                    'name_en' => $item['name_en'],
//                    'description_ar' => $item['description_ar'],
//                    'description_en' => $item['description_en'],
//                    'price' => $item['price'],
//                    'calories' => $item['calories'],
//                    'image' => '',
//                ]);
//
//
//                if ($request->hasFile('image')) {
//                    $image = $request->image;
//                    $image_new_name = time() . $image->getClientOriginalName();
//                    $image->move(public_path('items'), $image_new_name);
//                    $item->image = '/items/' . $image_new_name;
//                    $item->save();
//                }
//            }
//        }

//        if ($request->has('Extra')) {
//            $extras = $request->get('Extra');
//            foreach ($extras as $extra) {
//                $extra = Extra::create([
//                    'name_ar' => $extra['name_ar'],
//                    'name_en' => $extra['name_en'],
//                    'price' => $extra['price'],
//                    'calories' => $extra['calories'],
//                    'category_id' => $category->id,
//                    'image' => '',
//                ]);
//
//
//                if ($request->hasFile('image')) {
//                    $image = $request->image;
//                    $image_new_name = time() . $image->getClientOriginalName();
//                    $image->move(public_path('extras'), $image_new_name);
//                    $extra->image = '/extras/' . $image_new_name;
//                    $extra->save();
//                }
//            }
//        }

        if ($request->dough_type_id) {
            $category->dough_type_id = (int)$request->dough_type_id;
            $category->save();
        } else {
            $category->dough_type_id = null;
            $category->save();
        }

        return redirect()->route('admin.category.index')->with([
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
    public function show(Request $request, Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $items = $category->items;
        $extras = $category->extras;

        return view('admin.category.edit', compact('category', 'items', 'extras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|min:3|max:20',
            'name_en' => 'required|min:3|max:20',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();

        if ($request->hasFile('image')) {
            if (File::exists(storage_path('app/public/' . $category->image))) {
                File::delete(storage_path('app/public/' . $category->image));
            }

            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('categories'), $image_new_name);
            $category->image = '/categories/' . $image_new_name;
            $category->save();
        }

        $category->name_ar = $request->name_ar;
        $category->name_en = $request->name_en;
        $category->description_ar = $request->description_ar;
        $category->description_en = $request->description_en;

        $category->updated_by = auth()->id();
        $category->save();

        if ($request->dough_type_id) {
            $category->dough_type_id = (int)$request->dough_type_id;
            $category->save();
        } else {
            $category->dough_type_id = null;
            $category->save();
        }


        if ($request->has('Item'))
            $category->items()->updateOrCreate($request->Item);
        // {
        //     $items = Item::where(['category_id' => $category->id])->get();

        //     $items = $category->items;
        //     $items->each->delete();
        //     $new_items = $request->get('Item');
        //     foreach ($new_items as $item) {
        //         $item = Item::create([
        //             'category_id' => $category->id,
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
            $category->extras()->updateOrCreate($request->Extra);
        // {
        //     $extras = $category->extras;
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
        //             'category_id' => $category->id,

        //         ]);
        //     }
        // }

        return redirect()->route('admin.category.index')->with([
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
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with([
            'type' => 'error', 'message' => 'category deleted successfuly'
        ]);
    }
}
