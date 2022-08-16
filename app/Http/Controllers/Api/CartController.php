<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Auth;
use Validator;

class CartController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCart()
    {
        return $this->sendResponse(Auth::user()->carts()->with('item')->get(), 'User Cart Retrieved');
    }

    public function addCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'item_id' => ['required', 'exists:items,id'],
            //'extras' => ['required'],
            'quantity' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $cart = Cart::create([
                'user_id' =>  Auth::user()->id,
                'item_id' =>  $request->item_id,
                'extras' =>  $request->extras,
                'withouts' =>  $request->withouts,
                'dough_type_ar' =>  $request->dough_type_ar,
                'dough_type_en' =>  $request->dough_type_en,
                'quantity' =>  $request->quantity,
                'offer_id' =>  $request->offer_id,
                'offer_price' =>  $request->offer_price,
            ]);

        // $cart = new Cart;
        // $cart->user_id = Auth::user()->id;
        // $cart->item_id = $request->item_id;
        // $cart->extras = $request->extras;
        // $cart->quantity = $request->quantity;
        // $cart->offer_id = $request->offer_id;
        // $cart->offer_price = $request->offer_price;
        // $cart->save();

        return $this->sendResponse($cart, 'Cart Created Successfully');
    }

    public function deleteCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $deletedID = Auth::user()->carts()->where('id', $request->cart_id)
            ->select('id')->get();
        $cart = Auth::user()->carts()->findOrFail($request->cart_id);
        if($cart->offer_id){
            $offer = Offer::find($cart->offer_id);
            /* to delete offer(buy and get) package from cart */
            if($offer->offer_type == 'buy-get'){
                $deletedID = Auth::user()->carts()->where('offer_id', $cart->offer_id)
                    ->where('created_at', $cart->created_at)
                    ->select('id')->get();
                Auth::user()->carts()->where('offer_id', $cart->offer_id)
                    ->where('created_at', $cart->created_at)
                    ->delete();
                return $this->sendResponse($deletedID, 'User Cart Item Deleted');
            }
        }
        $cart->delete();
        return $this->sendResponse($deletedID, 'User Cart Item Deleted');
    }

    public function updateQuantity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => ['required'],
            'quantity'=> ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        Auth::user()->carts()->findOrFail($request->cart_id)->update(['quantity' => $request->quantity]);

        return $this->sendResponse(Auth::user()->carts()->with('item')->get(), 'User Cart Updated');
    }

}
