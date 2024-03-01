<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\CustomerDetails;
use App\CustomerPackage;
use App\Chat;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
        protected function credentials(Request $request)
        {
            return [$this->username() => $request->{$this->username()}, 'password' => $request->password, 'status' => 1];
        }

    public function authenticated(Request $request)
    {
        // Logic that determines where to send the user
        if($request->user()->role_id == 1){
            return redirect(route('admin.dashboard'));
        }
        elseif($request->user()->role_id == 3){

            return redirect(route('astrologer.dashboard'));
        }
        elseif($request->user()->role_id == 2){
            return redirect(route('customer.dashboard'));
        }
        elseif($request->user()->role_id == 5){
            return redirect(route('psychologist.dashboard'));
        }
        elseif($request->user()->role_id == 4){
            return redirect(route('moderator.dashboard'));
        }
        else{
            $this->middleware('guest')->except('logout');
        }
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function __construct()
    {
        if(Auth::check() && Auth::user()->role_id == 1){
        $this->redirectTo = route('admin.dashboard');
        }
        $this->middleware('guest')->except('logout');
    }

     public function redirectToGoogle()
        {
            return Socialite::driver('google')->redirect();
        }

        public function handleGoogleCallback()
        {
            try {

                $user = Socialite::driver('google')->user();

                $finduser = User::where('email', $user->email)->first();

                if($finduser){

                    Auth::login($finduser);

                    return redirect(route('customer.dashboard'));

                }else{
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                         'password' => Hash::make('12345678'),
                    ]);

                    $newUser->email_verified_at = now();
                    $newUser->save();
                 $customer_details = new CustomerDetails() ;
                         $customer_details->user_id = $newUser->id;
                         $customer_details->mac_address = substr(exec('getmac'), 0, 17);
                         $customer_details->platform = 'Web';
                          $customer_details->save();
                        $customer_package = new CustomerPackage();
                        $customer_package->customer_id = $newUser->id;
                        $customer_package->package_id = 1;
                        $customer_package->question_left = 1;
                          $customer_package->save();
                        $welcome_message = "Welcome to Aspect Astrology. We offer comprehensive HOROSCOPES, FUTURE PREDICTIONS, and cost-effective counseling sessions ranging from marriage-related concerns to relationships (love life), financial difficulties to career challenges, or any other specific issues. Our team of certified expert astrologers will look at the celestial bodies at the moment of your birth, which might affect your luck in love, finance, business, and many other areas of life. Take use of this time to plan for issues that have been bothering you for some time, or to speak with a specialist on anything that you feel strongly about. It is difficult to find someone who can listen, comprehend, and, above all, Astrologers and counselors who can completely assist you through your current life difficulties, but we are here to help. NOTE: Sample Questions may be found in the MENU bar in the upper left corner. Thank you very much.";
                         $customer_welcome_message = new Chat();
                         $customer_welcome_message->message = $welcome_message;
                        $customer_welcome_message->read = 0;
                        $customer_welcome_message->sender_id = 1;
                        $customer_welcome_message->receiver_id = $newUser->id;
                        $customer_welcome_message->save();

                    Auth::login($newUser);

                    return redirect(route('customer.dashboard'));
                }

            } catch (Exception $e) {

                return redirect('auth/google');
            }
        }
}
