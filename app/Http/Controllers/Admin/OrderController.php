<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Filters\OrderFilters;
use App\Models\OrderItem;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('admin.order.index' , compact('orders'));
    }

    public function show(Request $request, $order_id)
    {
        $orderDetails = OrderItem::where('order_id', $order_id)->get();
        return view('admin.order.details' , compact('orderDetails'));
    }
}
