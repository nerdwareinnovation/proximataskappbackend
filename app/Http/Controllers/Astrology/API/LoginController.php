<?php

namespace App\Http\Controllers\Astrology\API;

use App\Http\Resources\CustomerDetailsResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Astrology\CustomerDetails;
use App\Models\Astrology\CustomerPackage;
use App\Models\Astrology\Chat;
use Laravel\Socialite\Facades\Socialite;
use Hash;
class LoginController extends Controller
{
    protected $success = 200;
    protected $error = 401;

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            $userUpdate = CustomerDetails::where('user_id','=',Auth::user()->id)->first();

            $userUpdate->fcm_token=$request['fcm_token'];

            $userUpdate->save();
            $token = $user->createToken('passport_token')->accessToken;

            return response()->json($token);
        }
        else {
//            //if authentication is unsuccessfull, notice how I return json parameters
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }
    public function requestTokenGoogle(Request $request){
//        $parameters = ['access_type' => 'offline'];
        // Getting the user from socialite using token from google
//        $user = Socialite::driver('google')->userFromToken($request->access_token);

        $user = Socialite::driver('google')->stateless()->userFromToken($request->access_token);
        // Getting or creating user from db
        $userFromDb = User::where(
            'email',$user->email

            )->first();

//        $userFromDb->password = Hash::make('12345678');
//        $userFromDb->save();
        if ($userFromDb == null){
            $userFromDb = new User();
            $userFromDb->email = $user->email;
            $userFromDb->name = $user->name;
            $userFromDb->email_verified_at = now();
            $userFromDb->save();
            $user_details = new CustomerDetails();
            $user_details->user_id = $userFromDb->id;
            $user_details->imageUrl = $user->avatar;

            $userFromDb->role_id = 2;
            $user_details->platform = "Android";
            $user_details->deviceId = $request['device_id'];


    //         $user_details->mac_address =exec('getmac');


            $user_details->save();
            $customer_package = new CustomerPackage();
            $customer_package->customer_id = $userFromDb->id;
            $customer_package->package_id = 1;
            $customer_package->question_left = 1;
            $customer_package->save();
            $welcome_message = "Welcome to Proxima Astrology. We offer comprehensive HOROSCOPES, FUTURE PREDICTIONS, and cost-effective counseling sessions ranging from marriage-related concerns to relationships (love life), financial difficulties to career challenges, or any other specific issues. Our team of certified expert astrologers will look at the celestial bodies at the moment of your birth, which might affect your luck in love, finance, business, and many other areas of life. Take use of this time to plan for issues that have been bothering you for some time, or to speak with a specialist on anything that you feel strongly about. It is difficult to find someone who can listen, comprehend, and, above all, Astrologers and counselors who can completely assist you through your current life difficulties, but we are here to help. NOTE: Sample Questions may be found in the MENU bar in the upper left corner. Thank you very much.";
            $customer_welcome_message = new Chat();
            $customer_welcome_message->message = $welcome_message;
            $customer_welcome_message->read = 0;
            $customer_welcome_message->sender_id = 1;
            $customer_welcome_message->receiver_id = $userFromDb->id;
            $customer_welcome_message->save();
        }
        $auth = Auth::loginUsingId($userFromDb->id);
//        if (auth('api')->loginUsingId($userFromDb->id)){
//            $user = auth('api')->user();
//            $user =  $userFromDb->first();
        $user = Auth::user();
        if ($auth){
            $userUpdate = CustomerDetails::where('user_id','=',$user->id)->first();

            $userUpdate->fcm_token=$request['fcm_token'];

            $userUpdate->save();
             $token = $user->createToken('passport_token')->accessToken;
           // Returning response
            return response()->json($token);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ], 401);
        }



    }
    public function requestTokenApple(Request $request){
//        $parameters = ['access_type' => 'offline'];
        // Getting the user from socialite using token from google
//        $user = Socialite::driver('google')->userFromToken($request->access_token);

        $user = Socialite::driver('apple')->stateless()->userFromToken($request->access_token);
        // Getting or creating user from db
        $userFromDb = User::where(
            'email',$user->email

        )->first();
//        $userFromDb->password = Hash::make('12345678');
//        $userFromDb->save();
        if ($userFromDb == null){
            $userFromDb = new User();
            $userFromDb->email = $user->email;
            $userFromDb->name = $request->user_name;
            $userFromDb->email_verified_at = now();
            $userFromDb->save();
            $user_details = new CustomerDetails();
            $user_details->user_id = $userFromDb->id;
            $user_details->imageUrl = $user->avatar;

            $userFromDb->role_id = 2;
            $user_details->platform = "Android";
            $user_details->deviceId = $request['device_id'];


            //         $user_details->mac_address =exec('getmac');


            $user_details->save();
            $customer_package = new CustomerPackage();
            $customer_package->customer_id = $userFromDb->id;
            $customer_package->package_id = 1;
            $customer_package->question_left = 1;
            $customer_package->save();
            $welcome_message = "Welcome to Proxima Astrology. We offer comprehensive HOROSCOPES, FUTURE PREDICTIONS, and cost-effective counseling sessions ranging from marriage-related concerns to relationships (love life), financial difficulties to career challenges, or any other specific issues. Our team of certified expert astrologers will look at the celestial bodies at the moment of your birth, which might affect your luck in love, finance, business, and many other areas of life. Take use of this time to plan for issues that have been bothering you for some time, or to speak with a specialist on anything that you feel strongly about. It is difficult to find someone who can listen, comprehend, and, above all, Astrologers and counselors who can completely assist you through your current life difficulties, but we are here to help. NOTE: Sample Questions may be found in the MENU bar in the upper left corner. Thank you very much.";
            $customer_welcome_message = new Chat();
            $customer_welcome_message->message = $welcome_message;
            $customer_welcome_message->read = 0;
            $customer_welcome_message->sender_id = 1;
            $customer_welcome_message->receiver_id = $userFromDb->id;
            $customer_welcome_message->save();
        }
        $auth = Auth::loginUsingId($userFromDb->id);
//        if (auth('api')->loginUsingId($userFromDb->id)){
//            $user = auth('api')->user();
//            $user =  $userFromDb->first();
        $user = Auth::user();
        if ($auth){
            $userUpdate = CustomerDetails::where('user_id','=',$user->id)->first();

            $userUpdate->fcm_token=$request['fcm_token'];

            $userUpdate->save();
            $token = $user->createToken('passport_token')->accessToken;
            // Returning response
            return response()->json($token);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ], 401);
        }



    }

    public function user(Request $request){
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->get();
        return response()->json([
            'data'=> $user,
            'message'=>"User profile has been updated successfully",
            'status'=>200,
        ]);
    }

    public function logout(){
            $userUpdate = CustomerDetails::where('user_id','=', auth()->user()->id)->first();

            $userUpdate->fcm_token = null;

            $userUpdate->save();


        return auth()->user()->tokens->each(function ($token){
            $token->delete();
        });
        return response()->json('Logout Successfully',200);

    }

}
