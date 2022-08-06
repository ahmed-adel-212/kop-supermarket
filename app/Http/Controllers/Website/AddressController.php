<?php

namespace App\Http\Controllers\Website;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function get_address()
    {
        $request = new \Illuminate\Http\Request();

        $return = (app(\App\Http\Controllers\Api\AddressesController::class)->index($request))->getOriginalContent();
        $return2 = (app(\App\Http\Controllers\Api\AuthController::class)->getUserPoints($request))->getOriginalContent();
        $return3 = (app(\App\Http\Controllers\Api\HelperController::class)->getCities())->getOriginalContent();
        if ($return2['success'] == 'success') {
            $points = $return2['data'];
        }

        if ($return3['success'] == 'success') {
            $cities = $return3['data'];
        }
        if ($return['success'] == 'success') {
            $addresses = $return['data'];
        }

        return view('website.profile', compact(['addresses', 'points', 'cities']));
    }

    public function delete(Address $address)
    {
        $request = new \Illuminate\Http\Request();
        $return = (app(\App\Http\Controllers\Api\AddressesController::class)->destroy($address, $request))->getOriginalContent();
        if ($return['success'] == 'success') {
            return redirect()->route('profile')->with('success', __('general.address deleted successfully'));
        }
        if ($return['success'] == false) {
            return redirect()->route('profile')->with('error', __('general.you can\'t delete this address'));

        }

    }

    public function store(Request $request)
    {
        $return = (app(\App\Http\Controllers\Api\AddressesController::class)->store($request))->getOriginalContent();
        if ($return['success'] == true) {
            return redirect('profile')->with(['success' => __('general.Address been Add!')]);

        } else {

            return redirect('profile')->with(['error' => __('general.Address Can Not be Add!')]);
        }
    }

    public function update(Address $address, Request $request)
    {
        $success = 'Your Address Been Updated.';

        $return = (app(\App\Http\Controllers\Api\AddressesController::class)->update($request, $address))->getOriginalContent();
        if ($return['success'] == true) {
            session()->put(['success' => 'Address been Updated!']);

            return redirect()->route('profile');
        }


        if ($return['success'] == false) {
            $errorarray = [];
            session()->put(['error' => 'Address Can Not be Updated!']);

            if (array_key_exists('message', $return)) {
                $errorarray['message'] = "Update Addresses Failed";

                return view('website.profile', compact(['errorarray']));
            } else {
                if ($return['error']->first('city_id')) {
                    $errorarray['city_id'] = $return['message']->first('city_id');
                }
                if ($return['error']->first('name')) {
                    $errorarray['name'] = $return['message']->first('name');
                }
                if ($return['error']->first('password')) {
                    $errorarray['area_id'] = $return['message']->first('area_id');
                }

                return view('website.profile', compact(['errorarray']));
            }
            return redirect()->route('profile');
        }

    }
}
