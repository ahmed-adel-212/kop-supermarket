<?php

namespace App\Http\Controllers\Website;

use App\Models\Branch;
use App\Models\Extra;
use App\Models\Item;
use App\Models\Offer;
use App\Models\OfferDiscount;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\Without;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    use GeneralTrait;

    public function make_order(Request $request)
    {
        // return $request;
        $items = auth()->user()->carts;
        foreach ($items as $item) {
            $item->extras = json_decode($item->extras);
            $item->withouts = json_decode($item->withouts);
            $item->offerId = $item->offer_id;
            $item->offer_price = round($item->offer_price, 2);
            $item->price = Item::find($item->item_id)->price;
        }

        if (!$request->has('points_paid')) {
            $request = $request->merge([
                'items' => $items,
                'points_paid' => 0,
            ]);
        } else {
            $request = $request->merge([
                'items' => $items,
                'points_paid' => $request->points_paid,
            ]);
        }

        $return = $this->store_order($request);


        if ($return['success'] == true) {
            foreach ($items as $item) {
                $item->delete();
            }
            if (session()->has('point_claim_value')) {
                session()->forget('point_claim_value');
            }
            return redirect()->route('get.cart')->with(['success' => __('general.Your order been submitted successfully')]);

        }
    }

    /* To view payment page */
    public function make_order_payment(Request $request)
    {
        if ($request->status == 'paid' && $request->message == 'Succeeded!' && session('checkOut_details')) {

            if (session()->has('checkOut_details')) {
                $request->merge([
                    'total' => session('checkOut_details')['total'],
                    'subtotal' => session('checkOut_details')['subtotal'],
                    'delivery_fees' => session('checkOut_details')['delivery_fees'],
                    'branch_id' => session('checkOut_details')['branch_id'],
                    'address_id' => array_key_exists('address_id', session('checkOut_details')) ? session('checkOut_details')['address_id'] : null,
                    'service_type' => session('checkOut_details')['service_type'],
                    'points_paid' => array_key_exists("points_paid", session('checkOut_details')) ? session('checkOut_details')['points_paid'] : 0,
                    'taxes' => session('checkOut_details')['taxes'],
                    'customer_id' => auth()->user()->id,
                ]);

                // submit order
                $items = auth()->user()->carts;
                foreach ($items as $item) {
                    $item->extras = json_decode($item->extras);
                    $item->withouts = json_decode($item->withouts);
                    $item->offerId = $item->offer_id;
                    $item->offer_price = round($item->offer_price, 2);
                    $item->price = Item::find($item->item_id)->price;
                }
                if (!$request->has('points_paid')) {
                    $request = $request->merge([
                        'items' => $items,
                        'points_paid' => 0,
                    ]);
                } else {
                    $request = $request->merge([
                        'items' => $items,
                        'points_paid' => $request->points_paid,

                    ]);
                }
                $return = $this->store_order($request);
                if ($return['success'] == true) {

                    Payment::create([
                        'payment_id' => $request->id,
                        'customer_id' => auth()->user()->id,
                        'status' => $request->status,
                        'message' => $request->message,
                        'order_id' => $return['data']->id,
                        'total_paid' => $request->amount / 100
                    ]);
                    session()->put(['success' => $return['success']]);
                    foreach ($items as $item) {
                        $item->delete();
                    }
                    if (session()->has('point_claim_value')) {
                        session()->forget('point_claim_value');
                    }
                    session()->flash('success', __('general.Order Payed Successfully'));
                    return redirect()->route('get.cart');
                }
            }
        } else {
            if ($request->status == 'failed') {
                switch ($request->message) {
                    case 'Unable to process the purchase transaction':
                        return redirect(route('get.payment'))->with(['error' => __('general.Unable to process the purchase transaction')]);
                    case 'Insufficient Funds':
                        return redirect(route('get.payment'))->with(['error' => __('Insufficient Funds')]);
                    case 'Declined':
                        return redirect(route('get.payment'))->with(['error' => __('Declined')]);
                    default:
                        return redirect(route('get.payment'))->with(['error' => $request->message]);
                }
                return redirect(route('get.payment'))->with(['error' => $request->message]);
            }
            session()->flash('error', 'Order Failed ! , Please Try again later');
            return redirect()->route('get.payment');
        }
    }

    public function my_orders()
    {
        $pending_orders = auth()->user()->orders()->where('state', 'pending')->paginate(5, ['*'], 'pending');
        $completed_orders = auth()->user()->orders()->where('state', 'completed')->paginate(5, ['*'], 'completed');
        //$inprogress_orders = auth()->user()->orders()->where('state', 'in-progress')->paginate(10);
        $canceled_orders = auth()->user()->orders()->where('state', 'canceled')->paginate(5, ['*'], 'canceled');
        //$on_way = auth()->user()->orders()->where('state', 'on-way')->paginate(10);

        return view('website.myOrder', compact('pending_orders', 'completed_orders', 'canceled_orders'));
    }

    public function my_orders_details($id, $reorder = null)
    {

        $order = Order::find($id);

        $items = $order->items;

        $items->map(function (&$item, $key) {
            if ($item->pivot->offer_id) {
                $offer = Offer::find($item->pivot->offer_id);
                if ($offer->date_to > now()) {
                    $item['valid'] = 1;
                } else {
                    $item['valid'] = 0;
                }
            }
        });
        if ($reorder != null) {
            return view('website.order_details', compact('items', 'order', 'reorder'));

        } else {
            return view('website.order_details', compact('items', 'order'));

        }
    }

    public function re_order($id)
    {
        $order = Order::find($id);
        $items = [];
        $deletedOfferPrice = 0;
        $final_item_price = 0;

        foreach ($order->items as $item) {
            if ($item->pivot->offer_id && (Offer::find($item->pivot->offer_id))['date_to'] < now()) {
                $extras_price = 0;
                $quantity = $item->pivot->quantity;
                $item_price = $item->pivot->price;
                $final_item_price = ($item_price * $quantity);
                if ($item->pivot->item_extras) {
                    $extras_price = Extra::whereIn('id', explode(', ', $item->pivot->item_extras))->sum('price') * $quantity;
                    $final_item_price += $extras_price;
                }
                $deletedOfferPrice += $final_item_price;
            }
            if ($item->pivot->offer_id && (Offer::find($item->pivot->offer_id))['date_to'] >= now()) {
                $quantity = $item->pivot->quantity;
                $item_price = ((Offer::find($item->pivot->offer_id))['offer_type'] == 'discount') ? round($this->calcOfferItem($item->pivot->offer_id, $item->id), 2) : $item->pivot->offer_price;
                $final_item_price = ($item_price * $quantity);
                if ($item->pivot->item_extras) {
                    $extras_price = Extra::whereIn('id', explode(', ', $item->pivot->item_extras))->sum('price') * $quantity;
                    $final_item_price += $extras_price;
                }
                $deletedOfferPrice += $final_item_price;
            } 
            if ($item->pivot->offer_id == null) {
                $quantity = $item->pivot->quantity;
                $item_price = Item::find($item->id)->price;
                $final_item_price = ($item_price * $quantity);
                if ($item->pivot->item_extras) {
                    $extras_price = Extra::whereIn('id', explode(', ', $item->pivot->item_extras))->sum('price') * $quantity;
                    $final_item_price += $extras_price;
                }
                $deletedOfferPrice += $final_item_price;
            }
            if ($item->pivot->offer_id && (Offer::find($item->pivot->offer_id))['date_to'] >= now()) {
                $items[] = collect([
                    'item_id' => $item->id,
                    'extras' => explode(', ', $item->pivot->item_extras),
                    'withouts' => explode(', ', $item->pivot->item_withouts),
                    'price' => Item::find($item->id)->price,
                    'dough_type_ar' => $item->pivot->dough_type_ar,
                    'dough_type_en' => $item->pivot->dough_type_en,
                    'offer_price' => ((Offer::find($item->pivot->offer_id))['offer_type'] == 'discount') ? $this->calcOfferItem($item->pivot->offer_id, $item->id) : $item->pivot->offer_price,
                    'offerId' => $item->pivot->offer_id,
                    'quantity' => $item->pivot->quantity

                ]);
            } else {

                $items[] = collect([
                    'item_id' => $item->id,
                    'extras' => explode(', ', $item->pivot->item_extras),
                    'withouts' => explode(', ', $item->pivot->item_withouts),
                    'price' => Item::find($item->id)->price,
                    'dough_type_ar' => $item->pivot->dough_type_ar,
                    'dough_type_en' => $item->pivot->dough_type_en,
                    'offer_price' => null,
                    'offerId' => null,
                    'quantity' => $item->pivot->quantity,
                ]);
            }
        }

//        $branch_id = session()->get('branch_id');
//        $address_id = session()->get('address_id');
//        $service_type = session()->get('service_type');
        $request = new \Illuminate\Http\Request();
        $request = $request->merge([
            'subtotal' => ($deletedOfferPrice != 0) ? $deletedOfferPrice : $order->subtotal,
        ]);
        $request = $request->merge([
            'taxes' => round($request->subtotal * .15, 2),
        ]);
        if($order->points_paid != 0){
            if(session('point_claim_value'))
            {
                $request = $request->merge([
                    'total' => ($deletedOfferPrice != 0) ? $deletedOfferPrice + $order->delivery_fees + $request->taxes - $request->points_paid : $order->total + $order->points_paid - session('point_claim_value'),
                ]);
            }else{
                $request = $request->merge([
                    'total' => ($deletedOfferPrice != 0) ? $deletedOfferPrice + $order->delivery_fees + $request->taxes : $order->total + $order->points_paid,
                ]);
            }
        }
        else{
            if(session('point_claim_value'))
            {
                $request = $request->merge([
                    'total' => ($deletedOfferPrice != 0) ? $deletedOfferPrice + $order->delivery_fees + $request->taxes - session('point_claim_value') : $order->total - session('point_claim_value'),
                ]);
            }else{
                $request = $request->merge([
                    'total' => ($deletedOfferPrice != 0) ? $deletedOfferPrice + $order->delivery_fees + $request->taxes : $order->total,
                ]);
            }
        }

        $request = $request->merge([
            'delivery_fees' => $order->delivery_fees,
            'points_paid' => (session('point_claim_value')) ? session('point_claim_value') : 0,
            'branch_id' => $order->branch_id,
            'address_id' => $order->address_id,
            'service_type' => $order->service_type,
            'items' => $items,
            'customer_id' => auth()->user()->id,
        ]);

        // remove 50% discount if user trying to reorder an order that has this offer
        $request->total = $this->removeDiscountIfNotFirstOrder(Auth::user(), $request->total);

        $return = $this->store_order($request);
        if (session()->has('point_claim_value')) {
            session()->forget('point_claim_value');
        }
        if ($return['success']) {
            return redirect()->route('get.orders')->with(['success' => __('general.Your order been submitted successfully')]);

        }

    }

    protected function calcOfferItem($offer_id, $item_id)
    {
        $price = Item::find($item_id)->price;
        $offer = Offer::find($offer_id);
        $offerDiscount = OfferDiscount::where('offer_id', $offer->id)->latest()->first();
        if ($offerDiscount->discount_type == 1) {
            $disccountValue = $price * $offerDiscount->discount_value / 100;
            return $price - $disccountValue;
        } elseif ($offerDiscount->discount_type == 2) {
            return $price - $offerDiscount->discount_value;
        }
    }

    public function store_order(Request $request)
    {
        // get customer information
        $customer = User::where('id', auth()->id())->whereHas('roles', function ($role) {
            $role->where('name', 'customer');
        })->first();

        $branch_id = 0;
        if ($request->service_type == 'delivery') {

            // validate user input
            $validator = Validator::make($request->all(), [
                'address_id' => 'required|exists:addresses,id',
                'service_type' => 'required',
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()];

            }
            $customerAddress = $customer->addresses->where('id', $request->address_id)->first();
            // get the branch covers customer area and open
            $area = $customerAddress->area;

            if ($area) {
                $branch = DB::table('branch_delivery_areas')->where('area_id', $area->id . "")->first();

                if ($branch) {
                    $branch = Branch::find($branch->branch_id);

                    if ($branch) {
                        $branch_id = $branch->id;
                    } else {
                        return ['error' => 'sorry there is no branch cover this area'];

                    }
                } else {
                    return ['error' => 'sorry there is no branch cover this area'];

                }
            } else {
                return ['error' => 'sorry there is no branch cover this area'];

            }
        }

        if ($request->service_type == 'takeaway') {

            // validate user input
            $validator = Validator::make($request->all(), [
                'branch_id' => 'exists:branches,id',
                'service_type' => 'required',
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()];
            }
            $branch = Branch::find($request->branch_id);

            if (!$branch) {
                return ['error' => 'there is no branch by this id'];

            }

            $branch_id = $branch->id;
        }

        // apply 50% discount if this is first order
        $request->total = $this->applyDiscountIfFirstOrder($customer, $request->total);

        $orderData = [
            "address_id" => $request->address_id,
            "customer_id" => $request->customer_id, //$request->user()->id,
            "branch_id" => $branch_id, //$branch->id,
            "service_type" => $request->service_type,
            "state" => 'pending',
            "subtotal" => round($request->subtotal, 2),
            "taxes" => round($request->taxes, 2),
            "delivery_fees" => $request->delivery_fees,
            "total" => round($request->total, 2),
            "points_paid" => $request->points_paid,
            'order_from' => 'website'
        ];

        $order = Order::create($orderData);
        if (!$order) {
            return ['error' => 'Order not found'];

        }
        // send notification to all user_branches
        $cashiers = Branch::find($branch_id);
        if ($cashiers) {
            if ($cashiers->cashiers2) {
                foreach ($cashiers->cashiers2 as $cashier) {

                    \App\Http\Controllers\NotificationController::pushNotifications($cashier->id, "New Order has been placed", "Order", null, null, $request->customer_id);
                }

            }
        }

        $subtotal = 0;
        foreach ($request->items as $item) {

            $orderItem = Item::where('id', $item['item_id'])->first();
            $orderItemExtras = null;
            if ($item['extras']) {
                $orderItemExtras = Extra::whereIn('id', $item['extras'])->get();
            }

            $orderItemWithouts = null;
            if ($item['withouts']) {
                $orderItemWithouts = Without::whereIn('id', $item['withouts'])->get();
            }


            // check if there is offer price
            // count sum of extras price and item price
            //if ($item->price) {

            $itemOfferPrice = 0;
            $itemPrice = 0;
            if ($item['offer_price'] != null && $item['offer_price']) {
                $extras = $orderItemExtras ? $orderItemExtras->sum('price') : 0;
                //$itemPrice = $item['price'] + $extras;
                $itemOfferPrice = round($item['offer_price'], 2) + $extras;
            }
            if ($item['price']) {
                $extras = $orderItemExtras ? $orderItemExtras->sum('price') : 0;
                $itemPrice = round($orderItem->price, 2) + $extras;
            }

            $subtotal = $subtotal + $itemPrice;
            $offer = Offer::find((isset($item['offerId']) && $item['offerId'] != null) ? $item['offerId'] : 0);
            $order->items()->attach($item['item_id'], [
                'item_extras' => ($item['extras']) ? implode(', ', $item['extras']) : null,
                'item_withouts' => ($item['withouts']) ? implode(', ', $item['withouts']) : null,
                'dough_type_ar' => ($item['dough_type_ar']) ? $item['dough_type_ar'] : null,
                'dough_type_en' => ($item['dough_type_en']) ? $item['dough_type_en'] : null,
                'price' => $itemPrice,
                'offer_price' => ($item['offer_price'] && $item['offer_price'] != null) ? $itemOfferPrice : null, // TODO: Remove price
                'offer_id' => optional($offer)->id,
                'offer_last_updated_at' => optional($offer)->updated_at,//??
                'quantity' => ($item['quantity']) ? $item['quantity'] : 1
            ]);
        }


        return ['success' => true, 'data' => $order];
    }


}
