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
        $carts = Auth::user()->carts()->with('item', 'size', 'color')->get();

        $totalPrice = 0;
        $subTotal = 0;
        $cart_data = [];
        foreach ($carts as $cart) {
            $subTotal += (int)$cart->quantity * (float)$cart->item->price;
            $totalPrice += (int)$cart->quantity * (float)($cart->offer_id ? $cart->offer_price : $cart->price);
            $cart_data['items'][] = $cart;
        }

        $cart_data['sub_total'] = $subTotal;
        $cart_data['total_price'] = $totalPrice;
        $cart_data['offer_price'] = $subTotal - $totalPrice;

        $cart_data = collect($cart_data)->toArray();

        return $this->sendResponse($cart_data, __('general.cart_ret'));
    }

    public function addCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'item_id' => ['required', 'exists:items,id'],
            //'extras' => ['required'],
            'quantity' => ['required', 'numeric'],
            'size_id' => 'required|exists:sizes,id',
            'color_id' => 'required|exists:colors,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $cart = Cart::create([
            'user_id' =>  Auth::user()->id,
            'item_id' =>  $request->item_id,
            'size_id' =>  $request->size_id,
            'color_id' =>  $request->color_id,
            'quantity' =>  $request->quantity,
            'offer_id' =>  $request->offer_id,
            'offer_price' =>  $request->offer_price,
        ]);

        return $this->sendResponse($cart, __('general.created', ['key' => __('general.cart')]));
    }

    public function deleteCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $deletedID = Auth::user()->carts()->where('id', $request->cart_id)
            ->select('id')->get();
        $cart = Auth::user()->carts()->findOrFail($request->cart_id);
        if ($cart->offer_id) {
            $offer = Offer::find($cart->offer_id);
            /* to delete offer(buy and get) package from cart */
            if($offer)
            {
                if ($offer->offer_type == 'buy-get') {
                    $deletedID = Auth::user()->carts()->where('offer_id', $cart->offer_id)
                        ->where('created_at', $cart->created_at)
                        ->select('id')->get();
                    Auth::user()->carts()->where('offer_id', $cart->offer_id)
                        ->where('created_at', $cart->created_at)
                        ->delete();
                    return $this->sendResponse($deletedID, __('general.deleted', ['key' => __('general.cart_item')]));
                }
            }
            else{
                $deletedID = Auth::user()->carts()->where('offer_id', $cart->offer_id)
                ->where('created_at', $cart->created_at)
                ->select('id')->get();
            Auth::user()->carts()->where('offer_id', $cart->offer_id)
                ->where('created_at', $cart->created_at)
                ->delete();
            return $this->sendResponse($deletedID, __('general.deleted', ['key' => __('general.cart_item')]));
        }
            }
        
        $cart->delete();
        return $this->sendResponse($deletedID, __('general.deleted', ['key' => __('general.cart_item')]));
    }

    public function updateQuantity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => ['required'],
            'quantity' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $cart = Auth::user()->carts()->findOrFail($request->cart_id);
        $cart->update(['quantity' => $request->quantity]);

        return $this->sendResponse($cart, __('general.updated', ['key' => __('general.cart')]));
    }
}
