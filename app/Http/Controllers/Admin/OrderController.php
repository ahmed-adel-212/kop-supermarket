<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Filters\OrderFilters;
use App\Http\Controllers\Api\OrdersController;
use App\Models\OrderItem;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\LogfileTrait;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    use LogfileTrait;

    public function index(OrderFilters $filters)
    {
        $user = Auth::user();
        if($user->hasRole('admin'))
        {
            $orders = Order::when(request()->order_from, function ($q) {
                return $q->where('order_from', request()->order_from);
            })->orderBy('id', 'DESC')->get();
        }
        else{
            $branches = $user->branches->pluck('id')->toArray();
             $orders = Order::whereIn('branch_id', $branches)->filter($filters)->orderBy('id', 'DESC')->get();
        }
        $this->Make_Log('App\Models\Order','view',0);
        return view('admin.order.index' , compact('orders'));
    }

    public function show(Request $request, $order_id)
    {
        $orderDetails = OrderItem::where('order_id', $order_id)->get();
        $this->Make_Log('App\Models\Order','view details',$order_id);
        return view('admin.order.details' , compact('orderDetails'));
    }

    public function update(Request $request, Order $order)
    {
        $req = $request->validate([
            'state' => 'required|in:in-progress,completed',
        ]);

        if ($request->state === 'completed') {
            (app(OrdersController::class)->completeOrder($request, $order))->getOriginalContent();
        }

        return redirect()->route('admin.order.index');
    }
}
