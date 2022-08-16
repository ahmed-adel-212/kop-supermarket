<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function update_user(Request $request)
    {
        $req = (object) $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::user()->id],
            'phone' => ['numeric', 'min:10'],
            'second_phone' => 'sometimes|numeric|min:10',
            'age' => 'required|integer|min:7',
            'image' => 'image|mimes:png,jpg,jpeg,gif|max:5000'
        ]);

        $user = Auth::user();
        $user->name = $req->name;
        $names = explode(' ', $req->name);
        $user->first_name = $names[0];
        $user->last_name = isset($names[1]) ? $names[1] : null;
        $user->first_phone = $req->phone;
        $user->second_phone = $req->second_phone;
        $user->age = $req->age;
        $user->email = $req->email;

        $img = null;
        if ($request->hasFile('image')) {
            $oldImage = $user->image;
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('customers'), $image_new_name);
            $img = '/customers/' . $image_new_name;

            if (File::exists(public_path('customers') . $oldImage)) {
                File::delete(public_path('customers') . $oldImage);
            }
        }
        $user->image = $img;

        $user->save();

        // dd($req, $user->toArray());
        // $return = (app(\App\Http\Controllers\Api\AuthController::class)->updateUser($request))->getOriginalContent();
        // if ($return['success'] == 'success') {
        //     $message = $return['message'];
        // }
        
        return redirect()->back()->with([
            'success' => __('general.user_updated'),
        ]);
    }
}
