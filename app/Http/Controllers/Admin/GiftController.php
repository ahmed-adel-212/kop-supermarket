<?php

namespace App\Http\Controllers\Admin;

use App\Models\General;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Session;

use App\Models\Gift;
use App\Models\GiftsOrder;
use App\Models\PointsTransaction;
use DB;

class GiftController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts = Gift::orderBy('id', 'DESC')->get();
        return view('admin.gift.index', compact('gifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|min:3|max:30',
            'name_en' => 'required|min:3|max:30',
            'points' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $branch = Gift::create([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'points' => $request->points,
            'image' => $request->image,
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('branchs'), $image_new_name);
            $branch->image = '/branchs/' . $image_new_name;
            $branch->save();
        }


        return redirect()->route('admin.gift.index')->with([
            'type' => 'success',
            'message' => 'Gift insert successfuly'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Gift $gift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gift $gift)
    {
        return view('admin.gift.edit', compact('gift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gift $gift)
    {

        $attributes = $request->validate([
            'name' => 'required|min:3|max:30',
            'name_en' => 'required|min:3|max:30',
            'points' => 'required|numeric'
        ]);

        $gift->update([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'points' => $request->points
        ]);

        if ($request->hasFile('image')) {
            $gift->update([
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            if ($request->hasFile('image')) {
                $image = $request->image;
                $image_new_name = time() . $image->getClientOriginalName();
                $image->move(public_path('gifts'), $image_new_name);
                $gift->image = '/gifts/' . $image_new_name;
                $gift->save();
            }
        }

        Session::flash('success', 'Gift has been updated');
        return redirect()->route('admin.gift.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gift $gift)
    {
        $gift->delete();

        return redirect()->route('admin.gift.index');
    }


    public function showGiftsOrders()
    {
        $orders = GiftsOrder::get();
        return view('admin.gift.showGiftsOrders', compact('orders'));
    }

    public function pointsValue()
    {
        $pointValue = DB::table('general')->where('key', 'pointsValue')->first();
        $value = 0;
        if($pointValue){
            $value = $pointValue->value;
        }
        return view('admin.gift.pointsValue', compact('value'));
    }

    public function pointsValuePost(Request $request)
    {
        $attributes = $request->validate([
            'value' => 'required|numeric|min:0'
        ]);

        $value = General::where('key', 'pointsValue')->updateOrCreate([
            'value' => $request->value,
            'key' => 'pointsValue',
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Value Updated Successfuly'
        ]);
    }

    public function showPointsTransactions()
    {
        $transactions = PointsTransaction::orderBy('id', 'DESC')->get();
        return view('admin.gift.showPointsTransactions', compact('transactions'));
    }
}
