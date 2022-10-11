<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Filters\ItemFilters;
use App\Models\Category;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Color;
use App\Models\HomeItem;
use App\Models\Size;
use Illuminate\Support\Facades\Validator;

use App\Traits\LogfileTrait;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use LogfileTrait;

    public function index(Request $request, ItemFilters $filters)
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        $items = Item::filter($filters)->orderBy('id', 'DESC')->get();
        $this->Make_Log('App\Models\Item', 'view', 0);
        return view('admin.items.index', compact('categories', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();

        $colors = Color::all();

        $brands = Brand::all();

        return view('admin.items.create', compact('categories', 'sizes', 'colors', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name_ar" => 'required|string',
            "name_en" => 'required|string',
            "description_ar" => 'nullable|required|string',
            "description_en" => 'nullable|required|string',
            "price" => 'required|numeric',
            // "calories" => 'required|numeric',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'website_image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            "category_id" => 'required|exists:categories,id',
            'sizes' => 'nullable|array',
            'colors' => 'nullable|array',
            'color_images' => 'nullable|array',
            'color_images.*' => 'mimes:jpeg,png,jpg',
            'brand_id' => 'required|exists:brands,id'
        ]);

        if (!isset($validatedData['sizes'])) {
            $validatedData['sizes'] = [];
        }
        if (!isset($validatedData['colors'])) {
            $validatedData['colors'] = [];
        }


        $sizes = $validatedData['sizes'];
        $colors = $validatedData['colors'];
        $color_images = isset($validatedData['color_images']) ? $validatedData['color_images'] : [];

        unset($validatedData['sizes']);
        unset($validatedData['colors']);
        unset($validatedData['color_images']);


        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('items'), $image_new_name);
            $validatedData['image'] = '/items/' . $image_new_name;
        }
        if ($request->hasFile('website_image')) {
            $image = $request->website_image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('items'), $image_new_name);
            $validatedData['website_image'] = '/items/' . $image_new_name;
        }
        $item = Item::create($validatedData);
        $this->Make_Log('App\Models\Item', 'create', $item->id);
        if (!$item) {
            return redirect()->route('admin.item.index')->with([
                'type' => 'error',
                'message' => 'test'
            ]);
        }

        $item->sizes()->sync($sizes);

        foreach ($colors as $colId) {
            $img = $color_images[$colId];
            $newImageName = time() . $img->getClientOriginalName();
            $img->move(public_path('colors'), $newImageName);
            $newImageName = '/colors/' . $newImageName;

            // saved color
            $item->colors()->attach($colId, ['image' => $newImageName]);
        }

        return redirect()->route('admin.item.index')->with([
            'type' => 'success',
            'message' => 'Item Update successfully'
        ]);
    }


    public function uploadImage(Request $request, $input_name = 'image', $user = null)
    {

        $ds = DIRECTORY_SEPARATOR;

        if ($request->has($input_name)) {
            $image = $request->file($input_name);

            $name = rand() . '_item_' . rand() . rand() . '.' . $image->getClientOriginalExtension();

            $folder = $ds . 'img' . $ds . 'items' . DIRECTORY_SEPARATOR;

            $filePath = $folder . $name;

            //dd(request()->{$input_name}->getSize() / (1024 * 1024));
            if (request()->{$input_name}->getSize() / (1024 * 1024) >= 2) {
                $this->compress(request()->{$input_name}, public_path($filePath));
                return $filePath;
            }

            request()->{$input_name}->move(public_path($folder), $name);
        }
        return $filePath;
    }

    public function compress($source, $path)
    {
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);

        $try = imagejpeg($image, $path, 60);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Item $item)
    {
        $item->loadMissing(['category', 'brand']);
        return view('admin.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Item $item)
    {
        $item->load('sizes', 'colors');
        $categories = Category::all();
        $userBranches = auth()->user()->branches;
        $sizes = Size::all();
        $itemSizes = $item->sizes->pluck('id')->toArray();

        $colors = Color::all();
        $itemColors = $item->colors->pluck('id')->toArray();
        $itemColorsAll = $item->colors;

        $brands = Brand::all();

        return view('admin.items.edit', compact('item', 'categories', 'sizes', 'itemSizes', 'colors', 'itemColors', 'itemColorsAll', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            "name_ar" => 'required|string',
            "name_en" => 'required|string',
            "description_ar" => 'nullable|required|string',
            "description_en" => 'nullable|required|string',
            "price" => 'required|numeric',
            // "calories" => 'required|numeric',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'website_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            "category_id" => 'required|exists:categories,id',
            'sizes' => 'nullable|array',
            'colors' => 'nullable|array',
            'color_images' => 'nullable|array',
            'color_images.*' => 'mimes:jpeg,png,jpg',
            'brand_id' => 'required|exists:brands,id'
        ]);

        if (!isset($validatedData['sizes'])) {
            $validatedData['sizes'] = [];
        }
        if (!isset($validatedData['colors'])) {
            $validatedData['colors'] = [];
        }

        $sizes = $validatedData['sizes'];
        $colors = $validatedData['colors'];
        $color_images = isset($validatedData['color_images']) ? $validatedData['color_images'] : [];

        unset($validatedData['sizes']);
        unset($validatedData['colors']);
        unset($validatedData['color_images']);

        if ($request->hasFile('image')) {
            $old_image = $item->image;
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('items'), $image_new_name);
            $validatedData['image'] = '/items/' . $image_new_name;

            if (file_exists(public_path($old_image))) {
                unlink(public_path($old_image));
            }
        }
        if ($request->hasFile('website_image')) {
            $image = $request->website_image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('items'), $image_new_name);
            $validatedData['website_image'] = '/items/' . $image_new_name;
        }

        if (!$item->update($validatedData)) {
            return redirect()->route('admin.item.index')->with([
                'type' => 'error',
                'message' => 'test'
            ]);
        }

        $item->loadMissing('colors');

        $item->sizes()->sync($sizes);

        // save colors with images
        // detach and delete old images first
        $oldColors = $item->colors;
        // $toBeDeleted = [];
        // echo "<pre>";
        // var_dump($oldColors->toArray());
        foreach ($item->colors as $col) {
            // $toBeDeleted[] = $col->pivot->image;
            $item->colors()->detach($col->id);
        }

        foreach ($colors as $colId) {
            if (isset($color_images[$colId])) {
                $img = $color_images[$colId];
                $newImageName = time() . $img->getClientOriginalName();
                $img->move(public_path('colors'), $newImageName);
                $newImageName = '/colors/' . $newImageName;
            } else {
                // var_dump($oldColors->where('id', $colId)->first()->pivot->image);
                $newImageSrc = optional(optional($oldColors->where('id', $colId)->first())->pivot)->image;
                $newImageName = $newImageSrc;
                // if (isset($toBeDeleted[$newImageSrc])) {
                //     unset($toBeDeleted[$newImageSrc]);
                // }
            }

            // saved color
            if ($newImageName) {
                $item->colors()->attach($colId, ['image' => $newImageName]);                
            }
        }

        // foreach ($toBeDeleted as $imgtoDel) {
        //     if (file_exists(public_path($imgtoDel))) {
        //         unlink(public_path($imgtoDel));
        //     }
        // }

        $this->Make_Log('App\Models\Item', 'update', $item->id);
        return redirect()->route('admin.item.index')->with([
            'type' => 'success',
            'message' => 'Item Update successfuly'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Item $item)
    {
        $item->delete();
        $this->Make_Log('App\Models\Item', 'delete', $item->id);
        return redirect()->back()->with([
            'type' => 'error', 'message' => 'Item deleted successfuly'
        ]);
    }

    public function getCategory($category)
    {
        $category = Category::findOrFail($category);

        $items = Item::where('category_id', $category->id)->get();

        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => $items
        ]);
    }

    public function dealOfWeekItem(ItemFilters $filters)
    {
        $categories = Category::all();
        $items = Item::filter($filters)->get();
        return view('admin.dealOfWeek.index', compact('categories', 'items'));
    }

    public function dealOfWeekStatus($itemId)
    {
        $item = Item::find($itemId);
        $item->best_seller = ($item->best_seller == 'activate') ? 'deactivate' : 'activate';
        $item->save();
        $this->Make_Log('App\Models\Item', 'dealOfWeekStatus', $itemId);
        return response()->json([
            'message' => 'success',
            'data' => $item->best_seller
        ]);
    }

    public function recommend(Item $item)
    {
        $item->recommended = true;
        $item->save();

        return back();
    }

    public function unRecommend(Item $item)
    {
        $item->recommended = false;
        $item->save();

        return back();
    }

    public function Homeitem(Request $request)
    {
        $homeitems = HomeItem::all()->load('item', 'category');
        return view('admin.homeitem.index', compact('homeitems'));
    }

    public function Create_Homeitem(Request $request)
    {
        $categories = Category::all();
        return view('admin.homeitem.create', compact('categories'));
    }
    public function Store_Homeitem(Request $request)
    {
        $validatedData = $request->validate([
            "description_ar" => 'required|string',
            "description_en" => 'required|string',
            "category_id" => 'required|exists:categories,id',
            "item_id" => 'required|exists:items,id',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'number' => 'required|unique:home_item',
        ]);


        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('items'), $image_new_name);
            $validatedData['image'] = '/items/' . $image_new_name;
        }

        $HomeItem = HomeItem::create($validatedData);
        $this->Make_Log('App\Models\HomeItem', 'create', $HomeItem->id);

        if (!$HomeItem)
            return redirect()->route('admin.homeitem.index')->with([
                'type' => 'error',
                'message' => 'test'
            ]);

        return redirect()->route('admin.homeitem.index')->with([
            'type' => 'success',
            'message' => 'homeitem Update successfully'
        ]);
    }
    public function Edit_Homeitem(Request $request, HomeItem $homeitem)
    {
        $categories = Category::all();
        $homeitem->load('item', 'category');
        return view('admin.homeitem.edit', compact('categories', 'homeitem'));
    }
    public function Update_Homeitem(Request $request, HomeItem $homeitem)
    {
        $validatedData = $request->validate([
            "description_ar" => 'required|string',
            "description_en" => 'required|string',
            "category_id" => 'required|exists:categories,id',
            "item_id" => 'required|exists:items,id',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('items'), $image_new_name);
            $validatedData['image'] = '/items/' . $image_new_name;
        }

        if (!$homeitem->update($validatedData))
            return redirect()->route('admin.homeitem.index')->with([
                'type' => 'error',
                'message' => 'test'
            ]);


        $homeitem->save();

        $this->Make_Log('App\Models\homeitem', 'update', $homeitem->id);
        return redirect()->route('admin.homeitem.index')->with([
            'type' => 'success',
            'message' => 'homeitem Update successfuly'
        ]);
    }

    public function Destroy_Homeitem(Request $request, HomeItem $homeitem)
    {
        $homeitem->update([
            "description_ar" => null,
            "description_en" => null,
            "category_id" => null,
            "item_id" => null,
            'image' => null,
        ]);
        $this->Make_Log('App\Models\HomeItem', 'delete', $homeitem->id);
        return redirect()->back()->with([
            'type' => 'error', 'message' => 'homeitem deleted successfuly'
        ]);
    }
}
