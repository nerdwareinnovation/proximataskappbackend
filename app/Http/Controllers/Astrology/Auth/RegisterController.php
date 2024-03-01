<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\CustomerDetails;
use App\CustomerPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Chat;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/customer/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'role_id' => 2,
                            'password' => Hash::make($data['password']),
                        ]);
            $customer_details = new CustomerDetails() ;
             $customer_details->user_id = $user->id;
             $customer_details->mac_address = substr(exec('getmac'), 0, 17);
             $customer_details->platform = 'Web';
              $customer_details->save();
            $customer_package = new CustomerPackage();
            $customer_package->customer_id = $user->id;
            $customer_package->package_id = 1;
            $customer_package->question_left = 1;
              $customer_package->save();
            $welcome_message = "Welcome to Proxima Astrology. We offer comprehensive HOROSCOPES, FUTURE PREDICTIONS, and cost-effective counseling sessions ranging from marriage-related concerns to relationships (love life), financial difficulties to career challenges, or any other specific issues. Our team of certified expert astrologers will look at the celestial bodies at the moment of your birth, which might affect your luck in love, finance, business, and many other areas of life. Take use of this time to plan for issues that have been bothering you for some time, or to speak with a specialist on anything that you feel strongly about. It is difficult to find someone who can listen, comprehend, and, above all, Astrologers and counselors who can completely assist you through your current life difficulties, but we are here to help. NOTE: Sample Questions may be found in the MENU bar in the upper left corner. Thank you very much.";
             $customer_welcome_message = new Chat();
             $customer_welcome_message->message = $welcome_message;
            $customer_welcome_message->read = 0;
            $customer_welcome_message->sender_id = 1;
            $customer_welcome_message->receiver_id = $user->id;
            $customer_welcome_message->save();
        $user->sendEmailVerificationNotification();

        return $user;
    }
}
