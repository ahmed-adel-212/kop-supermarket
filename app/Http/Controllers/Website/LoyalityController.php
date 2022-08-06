<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

}
