<?php

namespace App\Http\Controllers\API;

use App\CustomerDetails;
use App\CustomerPackage;
use App\Http\Resources\UserResource;
use App\User;
use App\Chat;


use Validator;
use Illuminate\Support\Facades\Hash;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RegisterController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
           'name' => 'required|string',
           'email' => 'required|string',
           'password' => 'required',


        ]);

        if ($validator->fails()){
            return response()->json([
                'message' => 'Given Data is invalid',
                'error' => $validator->errors(),
            ], 200);
        }
         $similarDevices = CustomerDetails::where('deviceId','=',$request['device_id'])->get();
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role_id = 2;
        $user->password = Hash::make($request['password']);
        $user->save();
        $token = $user->createToken('Token Name')->accessToken;
        $user_details = new CustomerDetails();
        $user_details->user_id = $user->id;

        $user_details->platform = "Android";
        $user_details->deviceId = $request['device_id'];


//         $user_details->mac_address =exec('getmac');


        $user_details->save();
        $customer_package = new CustomerPackage();
        $customer_package->customer_id = $user->id;
        $customer_package->package_id = 1;

        if($similarDevices->count() == 0 ){
         $customer_package->question_left = 1;

        }
        else{
                $customer_package->question_left = 0;

        }

        $customer_package->save();
        $welcome_message = "Welcome to Proxima Astrology. We offer comprehensive HOROSCOPES, FUTURE PREDICTIONS, and cost-effective counseling sessions ranging from marriage-related concerns to relationships (love life), financial difficulties to career challenges, or any other specific issues. Our team of certified expert astrologers will look at the celestial bodies at the moment of your birth, which might affect your luck in love, finance, business, and many other areas of life. Take use of this time to plan for issues that have been bothering you for some time, or to speak with a specialist on anything that you feel strongly about. It is difficult to find someone who can listen, comprehend, and, above all, Astrologers and counselors who can completely assist you through your current life difficulties, but we are here to help. NOTE: Sample Questions may be found in the MENU bar in the upper left corner. Thank you very much.";
        $customer_welcome_message = new Chat();
         $customer_welcome_message->message = $welcome_message;
        $customer_welcome_message->read = 0;
        $customer_welcome_message->sender_id = 1;
        $customer_welcome_message->receiver_id = $user->id;
        $customer_welcome_message->save();
        $user->sendEmailVerificationNotification();

        return response()->json($token);
//        return new UserResource($user);
    }
    public function verificationNotification(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return json_encode(['message', 'Verification link sent!']);
    }
}

