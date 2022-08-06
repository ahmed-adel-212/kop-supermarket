<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Gift;
use App\Models\PointsTransaction;

use App\Models\GiftsOrder;


use AWS;

class GiftsController extends BaseController
{
    public function getGifts(Request $request)
    {
        
        return $this->sendResponse(Gift::all(), 'Gifts Retrieved Successfully');
    }
    
    public function BuyGifts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gifts_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }
        
        $gifts = json_decode($request->gifts_id);
        $available_points = Auth::user()->points_transactions()->whereIn('status', [0, 2])->sum('points');
        
        $gifts = Gift::whereIn('id', $gifts)->get();
        
        if ($gifts->sum('points') > $available_points) {
            return response()->json(['error' => 'You Don\'t have enough points'], 400);
        }
        
        $order = GiftsOrder::create([
                'user_id' => Auth::user()->id
            ]);
            
        $order->gifts()->sync(json_decode($request->gifts_id));
        
        PointsTransaction::create([
                'user_id' => Auth::user()->id,
                'order_id'=> $order->id,
                'status'  => 2,
                'points'  => 0 - $gifts->sum('points')
            ]);
        
        return $this->sendResponse($order, 'Order Done Successfully');
    }
    
    public function getUserGiftsOrders(Request $request)
    {
        
        return $this->sendResponse(Auth::user()->gifts_orders()->with('gifts')->get(), 'Code Resent Successfully');
    }

}
