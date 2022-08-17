<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PointsTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoyalityController extends Controller
{
    public function get_loyalty()
    {
        $request = new \Illuminate\Http\Request();

        $return2 = (app(\App\Http\Controllers\Api\AuthController::class)->getUserPoints($request))->getOriginalContent();
        if ($return2['success'] == 'success') {
            $points = $return2['data'];
        }

        return view('website.loyalty-points', compact(['points']));
    }

    public function get_loyalty_exchange()
    {
        $request = new \Illuminate\Http\Request();
        $request->merge(['points'=>100]);
        (app(\App\Http\Controllers\Api\AuthController::class)->changeUserPoints($request))->getOriginalContent();
        session()->put(['point_claim_value' => DB::table('general')->where('key', 'pointsValue')->first()->value]);
        return redirect()->route('profile');
    }

    public function getPage(Request $request)
    {
        $pointsApi = (app(\App\Http\Controllers\Api\AuthController::class)->getUserPoints($request))->getOriginalContent();
        $points =  $pointsApi['data'];

        $pointValues = DB::table('general')->where('key', 'pointsValue')->get();

        // history
        $completed = Order::where('state', 'completed')->where('customer_id', Auth::id())->get();
        $points_still = PointsTransaction::where('status', 0)->where('user_id', Auth::id())->get();
        $history = [];
        foreach ($completed as $order) {
            $history[] = (object)[
                'points' => $order->points * -1,
                'order_id' => $order->id,
                'created_at' => $order->updated_at,
            ];
        }
        foreach ($points_still as $point) {
            $history[] = (object)[
                'points' => (int)$point->points,
                'order_id' => (int)$point->order_id,
                'created_at' => $point->created_at,
            ];
        }

        $cartHasItems = Auth::user()->carts()->count() > 0;

        return view('website.loyality', compact('points', 'pointValues', 'history', 'cartHasItems'));
    }

    public function setValue($value, $points)
    {
        session(['loyality-points' => compact('value', 'points')]);

        return redirect()->route('get.cart');
    }
}
