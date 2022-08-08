<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PointsTransaction;

use App\Notifications\SignupActivate;
use App\Notifications\activateSMS;
use App\Traits\GeneralTrait;

class AuthController extends BaseController
{
    //website
    //
    //

    use GeneralTrait;

    public function login(Request $request)
    {

        $credentials = [
            'email' => request('email'),
            'password' => request('password')
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->hasRole('customer')) {
                if ($request->has('device_token')) {
                    $user->device_token = $request->device_token;
                    $user->save();
                }

                $user->branches; //??

                $data = [
                    'userData' => $user,
                    'token' => $user->createToken('AppName')->accessToken
                ];
                if (auth()->user()->email_verified_at == null) {
                    return $this->sendResponse($data, 'Must verify account');
                }
                return $this->sendResponse($data, 'User logged in successfuly');
            }
        }
        return $this->sendError('Unauthorised!', $credentials);
    }

    public function loginCashier(Request $request)
    {

        $credentials = [
            'email' => request('email'),
            'password' => request('password')
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('cashier')) {
                if ($request->has('device_token')) {
                    $user->device_token = $request->device_token;
                    $user->save();
                }
                $user->branches;


                $data = [
                    'userData' => $user,
                    'token' => $user->createToken('AppName')->accessToken
                ];

                if (auth()->user()->email_verified_at == null) {

                    return $this->sendResponse($data, 'Must verify account');
                }
                return $this->sendResponse($data, 'User logged in successfuly');
            }
        }
        return $this->sendError('Unauthorised!', 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'min:11']
        ]);
        //, 'unique:users,first_phone'
        if ($validator->fails()) {
            return response()->json(
                [
                    "success" => false,
                    'error' => $validator->errors()
                ],
                401
            );
        }

        DB::beginTransaction();
        try {
            $name = explode(" ", $request->name);
            if (count($name) < 2) {
                return response()->json([
                    "success" => false,
                    "message" => 'last_name_not_included',
                ], 400);
            }

            $request->merge([
                'first_name' => $name[0],
                'last_name' => $name[1],
                'password' => bcrypt($request->password),
                'first_phone' => $request->phone,
                'age' => $request->age,
                'activation_token' => mt_rand(100000, 999999)
            ]);

            $user = User::create($request->all());
            $user->attachRole(3); // customer

            $this->sendMessage(
                $user->first_phone,
                'KOP:Thanks for signup! Please before you begin, you must confirm your account. Your Code is:' . $user->activation_token
            );

            return $this->sendResponse($user, 'Successfully created user!');

            //            return $this->sendResponse($user, 'Successfully created user!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 400);

            //echo "Error: " . $e->getMessage();
        }

        DB::commit();


        // $user->notify(new SignupActivate($user));

        // // Temprorary
        // $user->notify(new activateSMS($user));

        // $message = $user->activation_token;
        // $sms = AWS::createClient('sns');
        // $message = "Thanks for signup! Please before you begin, you must confirm your account. Your Code is: " . $user->activation_token;
        // $number = "+2" . $user->first_phone;
        // $x = $sms->publish([
        //     'Message' => $message,
        //     'PhoneNumber' => $number,
        //     'MessageAttributes' => [
        //         'AWS.SNS.SMS.SMSType'  => [
        //             'DataType'    => 'String',
        //             'StringValue' => 'Transactional',
        //         ]
        //     ],
        // ]);
        // temp

        //test twilio


        // $client = new Client($accountSid, $authToken);
        // try {
        //     // Use the client to do fun stuff like send text messages!
        //     $client->messages->create(
        //         // the number you'd like to send the message to
        //         $user->first_phone,
        //         array(
        //             // A Twilio phone number you purchased at twilio.com/console
        //             'from' => '+16196584381',
        //             // the body of the text message you'd like to send
        //             'body' => 'KOP:Thanks for signup! Please before you begin, you must confirm your account. Your Code is:' . $user->activation_token,
        //         )
        //     );
        //     return $this->sendResponse($user, 'Successfully created user!');
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "success" => false,
        //         "message" => $e->getMessage()
        //     ], 400);

            //echo "Error: " . $e->getMessage();
        // }
        //end test Twillo


    }
    /* for verification */
    public function setVerificationCode(Request $request)
    {
        $user = $request->user();
        $user = $user->update(['email_verified_at' => now()]);
        return $this->sendResponse($user, 'Successfully customer verified.');
    }
    public function resendVerificationCode(Request $request)
    {
        try {
            $this->sendMessage(
                $request->user()->first_phone, 
                'KOP:Thanks for signup! Please before you begin, you must confirm your account. Your Code is:' . $request->user()->activation_token
            );
            return $this->sendResponse($request->user(), 'Sent SMS successfully');
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 400);

            //echo "Error: " . $e->getMessage();
        }
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->sendResponse(null, 'Successfully logged out');
    }

    public function getUser(Request $request)
    {
        return $this->sendResponse($request->user(), 'User data retrieved Successfully');
    }


    public function resendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $user = User::find($request->user_id);

        if ($user->activation_token == '') {
            return $this->sendError('Account is already activated', 400);
        }

        $user->notify(new SignupActivate($user));
        // wael remove comment
        $user->notify(new activateSMS($user));

        return $this->sendResponse($user, 'Code Resent Successfully');
    }

    public function getUserPoints(Request $request)
    {
        $validRefundedPoints = Auth::user()->points_transactions()->whereIn('status', [0, 3])->get()->sum('points');
        $consumedCanceledPoints = Auth::user()->points_transactions()->whereIn('status', [2, 4])->get()->sum('points');
        try {
            $data = [
                //'user_points' => Auth::user()->points_transactions()->whereIn('status', [0, 2])->get()->sum('points'),
                'user_points' => $validRefundedPoints - $consumedCanceledPoints,
                'points_value' => DB::table('general')->where('key', 'pointsValue')->first()->value
            ];
        } catch (\Exception $ex) {
            $data = [
                'user_points' => $validRefundedPoints - $consumedCanceledPoints,
                'points_value' => 0
            ];
        }


        return $this->sendResponse($data, 'Points Retrieved Successfully');
    }

    public function changeUserPoints(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'points' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $transaction = PointsTransaction::create([
            'points' => $request->points,
            'user_id' => Auth::user()->id,
            'status' => 2
        ]);
        return $this->sendResponse($transaction, 'Points Changed Successfully');
    }

    public function updateUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::user()->id],
            'password' => ['string', 'min:8'],
            'phone' => ['min:2'],
            'image' => 'image|max:5000'
        ]);
        $request->merge(['first_phone' => $request->phone]);
        if ($request->password) {
            $request->merge(['password' => bcrypt($request->password)]);
        }
        if ($request->user()) {
            $user = $request->user();
        } else {
            if (auth('web')->user()) {
                $user = auth()->user();
            }
        }
        $user = $user->update($request->except(['image']));

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('users'), $image_new_name);
            $user->image = '/users/' . $image_new_name;
            $user->save();
        }

        return $this->sendResponse($user, 'Successfuly customer updated.');
    }
    public function setFirstOfferFlag(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_offer_available' => ['required']
        ]);


        $user = $request->user();

        $user = $user->update($request->all());
        return $this->sendResponse($user, 'Successfully customer updated.');
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return $this->sendError('This activation token is invalid.');
        }

        $user->active = true;
        $user->activation_token = '';
        $user->save();

        $user = Auth::loginUsingId($user->id, true);

        $data = [
            'userData' => $user,
            'token' => $user->createToken('AppName')->accessToken
        ];

        return $this->sendResponse($data, "User Loged in successfully");
    }

    public function LoginWithGoogle(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user.id' => 'required',
            'user.givenName' => 'required',
            'user.familyName' => 'required',
            'user.email' => 'required|email',
        ]);

        if ($validator->fails())
            return $this->sendError("Validation errors", $validator->errors());

        $user_id = DB::table('third_party_user_ids')->where('google_user_id', $request->user['id'])->pluck('user_id')->first();

        if (!$user_id) {

            $user = User::where('email', $request->user['email'])->first();

            if (!$user) {
                $user = User::updateOrCreate([
                    'first_name' => $request->user['givenName'],
                    'last_name' => $request->user['familyName'],
                    'name' => $request->user['name'],
                    'email' => $request->user['email'],
                    'password' => '',
                    'image' => $request->user['photo'],
                    'activation_token' => mt_rand(100000, 999999),
                    'active' => 1
                ]);
                $user->attachRole(3);
            }

            DB::table('third_party_user_ids')->insert([
                'user_id' => $user->id,
                'google_user_id' => $request->user['id']
            ]);

            Auth::login($user, true);

            $data = [
                'userData' => $user,
                'token' => $user->createToken('AppName')->accessToken
            ];


            return $this->sendResponse($data, "User logged in successfully");
        }

        $user = Auth::loginUsingId($user_id, true);
        $data = [
            'userData' => $user,
            'token' => $user->createToken('AppName')->accessToken
        ];

        return $this->sendResponse($data, "User Loged in successfully");
    }


    public function loginWithFacebook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
        ]);

        if ($validator->fails())
            return $this->sendError("Validation errors", $validator->errors());

        $user_id = DB::table('third_party_user_ids')->where('facebook_user_id', $request->id)->pluck('user_id')->first();

        if (!$user_id) {

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                $user = User::updateOrCreate([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => '',
                    'activation_token' => mt_rand(100000, 999999),
                    'active' => 1
                ]);
                $user->attachRole(3);
            }

            DB::table('third_party_user_ids')->insert([
                'user_id' => $user->id,
                'facebook_user_id' => $request->id
            ]);

            Auth::login($user, true);

            $data = [
                'userData' => $user,
                'token' => $user->createToken('AppName')->accessToken
            ];

            return $this->sendResponse($data, "User logged in successfully");
        }

        $user = Auth::loginUsingId($user_id, true);
        $data = [
            'userData' => $user,
            'token' => $user->createToken('AppName')->accessToken
        ];

        return $this->sendResponse($data, "User Loged in successfully");
    }
}
