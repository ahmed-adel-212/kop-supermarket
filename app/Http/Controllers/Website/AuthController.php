<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function get_login()
    {
        return view('website.login');
    }

    public function get_sign_up()
    {
        return view('website.signup');
    }

    public function sign_up(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'min:11']
        ]);
        //, 'unique:users,first_phone'
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        }
        try {
            $name = explode(" ", $request->name);
            if (count($name) < 2) {
                return redirect()->back()->withErrors(['errors' => 'Name Must Include  First Name And Last Name !'])->withInput();
            }

            DB::beginTransaction();

            $request->merge([
                'first_name' => $name[0],
                'last_name' => $name[1],
                'password' => bcrypt($request->password),
                'first_phone' => $request->phone,
                'age' => $request->age,
                'activation_token' => mt_rand(100000, 999999)
            ]);

            $user = User::create($request->all());
            $user->attachRole(3);

            try {
                $this->sendMessage(
                    $user->first_phone,
                    'KOP:Thanks for signup! Please before you begin, you must confirm your account. Your Code is:' . $user->activation_token
                );
                // return redirect()->back()->with(['success'=>__('auth.Sent SMS successfully.')]);
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->back()->withErrors(['errors' => __('auth.phone_number_error')]);
            }

            return redirect(route('get.login'))->with(['success' => 'Your Account Created Successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Something Went Wrong!! please try again later']);
        }
        DB::commit();
    }

    public function login(Request $request)
    {
        $validation_rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $validatedData = $request->validate($validation_rules);


        $credentials = [
            'email' => request('email'),
            'password' => request('password')
        ];

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            if ($user->hasRole('customer')) {

                $user->branches; //??

                if (auth()->user()->email_verified_at == null) {
                    return redirect()->route('verifyCode.page');
                }
                return redirect()->route('home.page');
            }
        }
        return redirect()->back()->with(['error' => __('session_messages.Unauthorized! Please Check Your Credentials')]);
    }

    public function logout()
    {

        auth()->logout();
        session()->flush();
        return redirect()->route('get.login')->with(['success' => __('session_messages.Successfully logged out')]);
    }

    /* for verification */
    public function get_code()
    {
        return view('website.verification-code');
    }

    public function setVerificationCode()
    {
        $user = auth()->user();
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route('home.page');
    }

    public function resendVerificationCode()
    {
        try {
            $this->sendMessage(
                auth()->user()->first_phone,
                'KOP:Thanks for signup! Please before you begin, you must confirm your account. Your Code is:' . auth()->user()->activation_token
            );
            return redirect()->back()->with(['success' => __('auth.Sent SMS successfully.')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('auth.Try again later.')]);


            //echo "Error: " . $e->getMessage();
        }
    }
}
