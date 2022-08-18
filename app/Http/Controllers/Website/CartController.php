<?php

namespace App\Http\Controllers\Website;

use App\Models\Address;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addCart(Request $request)
    { 
        // return $request;
        
        if ($request->has('add_items')) {
            // dd(json_decode($request->add_items), $request->all());
            $items = json_decode($request->add_items);
            foreach ($items as $index => $item) {
                $newRequest = new Request();
                $newRequest->merge(['item_id' => $request->item_id]);
                $newRequest->merge(['offer_id' => $request->offer_id]);
                $newRequest->merge(['offer_price' => $request->offer_price?$request->offer_price[$index]:null]);
                $newRequest->merge(['quantity' => 1]);
                
                $dough = explode(',', $item->dough);
                $request->merge([
                    'dough_type_ar' => $dough[0],
                ]);
                $request->merge([
                    'dough_type_en' => $dough[1],
                ]);
                

                // dd([
                //     'user_id' =>  Auth::user()->id,
                //     'item_id' =>  $request->item_id,
                //     'extras' =>  json_encode($item->extras),
                //     'withouts' =>  json_encode($item->withouts),
                //     'dough_type_ar' =>  $request->dough_type_ar,
                //     'dough_type_en' =>  $request->dough_type_en,
                //     'quantity' =>  $request->quantity,
                //     'offer_id' =>  $request->offer_id,
                //     'offer_price' =>  $request->offer_price,
                // ]);
                
                $cart = Cart::create([
                    'user_id' =>  Auth::user()->id,
                    'item_id' =>  $request->item_id,
                    'extras' =>  json_encode($item->extras),
                    'withouts' =>  json_encode($item->withouts),
                    'dough_type_ar' =>  $request->dough_type_ar,
                    'dough_type_en' =>  $request->dough_type_en,
                    'quantity' =>  1,
                    'offer_id' =>  $request->offer_id,
                    'offer_price' =>  $request->offer_price,
                ]);

                // dump($cart);

            }
            return redirect()->route('menu.page');
        }
        if ($request->has('buy_items')) {
            foreach ($request->buy_items as $index => $buy_item) {
                $newRequest = new Request();
                $newRequest->merge(['item_id' => $buy_item]);
                $newRequest->merge(['offer_id' => $request->offer_id]);
                $newRequest->merge(['offer_price' => $request->offer_price[$index]]);
                $newRequest->merge(['quantity' => $request->quantity]);
                (app(\App\Http\Controllers\Api\CartController::class)->addCart($newRequest))->getOriginalContent();
            }
            foreach ($request->get_items as $get_item) {
                $newRequest = new Request();
                $newRequest->merge(['item_id' => $get_item]);
                $newRequest->merge(['offer_id' => $request->offer_id]);
                $newRequest->merge(['offer_price' => 0]);
                $newRequest->merge(['quantity' => $request->quantity]);
                (app(\App\Http\Controllers\Api\CartController::class)->addCart($newRequest))->getOriginalContent();
            }
            return redirect()->route('menu.page');
        }

        if ($request->has('dough_type')) {
            $dough_type = explode(',', $request->dough_type);
            $request->merge(['dough_type_ar' => $dough_type[0]]);
            $request->merge(['dough_type_en' => $dough_type[1]]);
        }

        $request->merge(['withouts' => json_encode($request->withouts)]);
        $request->merge(['extras' => json_encode($request->extras)]);
        $request->merge(['offer_price' => $request->offer_price]);

        $return = (app(\App\Http\Controllers\Api\CartController::class)->getCart())->getOriginalContent();

        if ($return['data']->count() > 0) {
            foreach ($return['data'] as $item) {
                if ($item->item_id == $request->item_id) {
                    if (($item->extras == $request->extras) && ($item->withouts == $request->withouts) && ($item->dough_type_en == $request->dough_type_en)) {
                        $cart = Cart::find($item->id);
                        $cart->quantity = $cart->quantity + $request->quantity;
                        $cart->save();
                        return redirect()->route('menu.page');
                    }
                }
            }
        }

        $return = (app(\App\Http\Controllers\Api\CartController::class)->addCart($request))->getOriginalContent();
        return redirect()->route('menu.page');
    }


    public function get_cart()
    {
        $return = (app(\App\Http\Controllers\Api\CartController::class)->getCart())->getOriginalContent();
        $request = new \Illuminate\Http\Request();
        if ($return['success'] == 'success') {
            $carts = $return['data'];
            $arr_check = $this->get_check();
            if (session()->has('point_claim_value')) {

                return view('website.cart', compact(['carts', 'arr_check']));
            } else {
                return view('website.cart', compact(['carts', 'arr_check']));

            }
        }
    }  public function get_cart_res()
    {
        $return = (app(\App\Http\Controllers\Api\CartController::class)->getCart())->getOriginalContent();
         if ($return['success'] == 'success') {
              return response()->json(['success'=>true,'data'=>count($return['data'])], 200);

         }
    }

    public function delete_cart(Request $request)
    {
        $deleteCart = (app(\App\Http\Controllers\Api\CartController::class)->deleteCart($request))->getOriginalContent();
        $carts = $deleteCart['data'];
        $arr_check = $this->get_check();
        return response()->json([
            'carts'=>$carts,
            'arr_check'=>$arr_check,
        ]);
    }

    public function update_quantity(Request $request)
    {
        $return = (app(\App\Http\Controllers\Api\CartController::class)->updateQuantity($request))->getOriginalContent();
        $arr_check = $this->get_check();

        return response()->json($arr_check);
    }

    public function get_check()
    {
        $return = (app(\App\Http\Controllers\Api\CartController::class)->getCart())->getOriginalContent();
        $arr_data = [];
        if ($return['success'] == 'success') {
            $carts = $return['data'];
            $final_item_price = 0;
            foreach ($carts as $index => $cart) {
                $quantity = $cart->quantity;
                if ($cart->offer_id) {
                    $item_price = $cart->offer_price;

                } else {
                    $item_price = $cart->item->price;
                }
                $final_item_price += ($item_price * $quantity);

                if ($cart->ExtrasObjects) {
                    $extras_price = collect($cart->ExtrasObjects)->sum('price') * $quantity;
                    $final_item_price += $extras_price;
                }
            }

            // if (session()->has('loyality-points')) {
                // $loyality = session('loyality-points');
                // $value = $loyality['value'];
                // $points = $loyality['points'];
                // $arr_data['points'] = round($value, 2);
                // $arr_data['taxes'] = round($final_item_price / 1.15, 2);
                // $arr_data['delivery_fees'] = session()->get('service_type') == 'delivery' ? round($this->get_delivery_fees(session()->get('branch_id')), 2) : 0;
                // $arr_data['subtotal'] = round($final_item_price, 2);
                // $final_item_price += ($arr_data['delivery_fees']) - $arr_data['points'];
                // $arr_data['total'] = round($final_item_price, 2);
                // return $arr_data;
            // }
            if (session()->has('point_claim_value')) {
                $arr_data['points'] = round(session()->get('point_claim_value'), 2);
                $arr_data['taxes'] = round($final_item_price / 1.15, 2);
                $arr_data['delivery_fees'] = session()->get('service_type') == 'delivery' ? round($this->get_delivery_fees(session()->get('branch_id')), 2) : 0;
                $arr_data['subtotal'] = round($final_item_price, 2);
                // $final_item_price += ($arr_data['taxes'] + $arr_data['delivery_fees']) - $arr_data['points'];
                if ($arr_data['subtotal'] <= $arr_data['points']) {
                    $arr_data['points'] = 0;
                }
                $final_item_price += ($arr_data['delivery_fees']) - $arr_data['points'];
                $arr_data['total'] = round($final_item_price, 2);
                return $arr_data;
            } else {
                $arr_data['taxes'] = round($final_item_price / 1.15, 2);
                $arr_data['delivery_fees'] = session()->get('service_type') == 'delivery' ? round($this->get_delivery_fees(session()->get('branch_id')), 2) : 0;
                $arr_data['subtotal'] = round($final_item_price, 2);
                // $final_item_price += $arr_data['taxes'] + $arr_data['delivery_fees'];
                $final_item_price += $arr_data['delivery_fees'];
                $arr_data['total'] = round($final_item_price, 2);
                return $arr_data;
            }

        }


    }

    public function get_checkout(Request $request)
    {
        if(auth()->user()->carts()->get()->count() <= 0 ){
            return redirect()->route('menu.page');
        }
        $service_type = session()->get('service_type');
        if ($service_type == 'delivery') {
            $address_id = session()->get('address_id');
            $request->merge(['address_id' => $address_id]);
        }
        $branch_id = session()->get('branch_id');
        $request->merge([
            'branch_id' => $branch_id,
            'service_type' => $service_type
        ]);

        $branch = Branch::where('id', $branch_id)->with(['city', 'area', 'deliveryAreas'])->with(['workingDays' => function ($day) {
            $day->where('day', strtolower(now()->englishDayOfWeek))->first();
        }])->first();

        $work_hours = $branch->workingDays()->where('day', strtolower(now()->englishDayOfWeek))->get();

        unset($request['_token']);
        session()->put(['checkOut_details' => $request->all()]);

        if (isset($address_id)) {
            $address = Address::find($address_id);
            return view('website.checkout', compact('request', 'address', 'work_hours'));
        }

        return view('website.checkout', compact('request', 'branch', 'work_hours'));


    }

    public function get_delivery_fees($branch_id)
    {

        $fees = Branch::where('id', $branch_id)->select('delivery_fees')->get();
        return ($fees[0]['delivery_fees']);
    }
}
