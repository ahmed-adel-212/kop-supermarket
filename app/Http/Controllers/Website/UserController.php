<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function update_user(Request $request )
    {

         $return = (app(\App\Http\Controllers\Api\AuthController::class)->updateUser($request))->getOriginalContent();
         if ($return['success'] == 'success') {
            $message = $return['message'];
        }
        return redirect()->back()->with(compact(['message']));
     }
}
