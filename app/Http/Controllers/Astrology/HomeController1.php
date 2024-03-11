<?php
//
//namespace App\Http\Controllers\Astrology;
//
//use App\Models\User;
//use App\Models\Astrology\CustomerDetails;
//use App\Models\Astrology\Chat;
//use Illuminate\Http\Request;
//use Auth;
//class HomeController extends Controller
//{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
//
//    /**
//     * Show the application dashboard.
//     *
//     * @return \Illuminate\Contracts\Support\Renderable
//     */
//    public function index()
//    {
//        // Logic that determines where to send the user
//        if(Auth::user()->role_id == 1){
//            return redirect(route('admin.dashboard'));
//        }
//        elseif(Auth::user()->role_id == 3){
//
//            return redirect(route('astrologer.dashboard'));
//        }
//        elseif(Auth::user()->role_id == 2){
//            return redirect(route('customer.dashboard'));
//        }
//        elseif(Auth::user()->role_id == 5){
//            return redirect(route('psychologist.dashboard'));
//        }
//        elseif(Auth::user()->role_id == 4){
//            return redirect(route('moderator.dashboard'));
//        }
//        else{
//            $this->middleware('guest')->except('logout');
//        }
//    }
//    public function home(){
//        return $this->index();
//    }
//    public function editProfile(){
//        return view('customer.updateProfile');
//    }
//
//    public function updateProfile(Request $request){
//        $validated = $request->validate([
//
//            'full_name' => 'required',
//            'dob' => 'required',
//            'tob' => 'required',
//
////            'genderRadio' => 'required',
//        ]);
//
//
//        $customer = CustomerDetails::where('user_id',auth()->user()->id)->first();
//        if(($customer->date_of_birth != $request['dob']) OR ($customer->time_of_birth != $request['tob']) OR ($customer->country_of_birth != $request['country']) OR ( $customer->state_of_birth != $request['state'])){
//            $chat = new Chat();
//            $chat->sender_id = auth()->user()->id;
//            $chat->receiver_id = 0;
//            $message = "Customer Details Changed<br>Date of Birth: ".$customer->date_of_birth." to ".$request['dob']."<br>Time of Birth: ".$customer->time_of_birth." to ".$request['tob']."<br>Country of Birth: ".$customer->country_of_birth." to ".$request['country']."<br>State of Birth: ".$customer->state_of_birth." to ".$request['state']."<br>Gender: ".$customer->gender." to ".$request['genderRadio'];
//            $chat->message = $message;
//            $chat->read = 0;
//            $chat->save();
//        }
//        $customer->date_of_birth = $request['dob'];
//        $customer->time_of_birth = $request['tob'];
//        $customer->country_of_birth = $request['country'];
//        $customer->state_of_birth = $request['state'];
//        $customer->city_of_birth = $request['city'];
//
//
//        $customer->gender = $request['genderRadio'];
//        $image = $request->file('user_image');
//        if ($image) {
//            if (file_exists($customer->imageUrl)){
//                unlink($customer->imageUrl);
//            }
//            $image_name = date('dmy_H_s_i');
//            $ext = strtolower($image->getClientOriginalExtension());
//            $image_full_name = $image_name . '.' . $ext;
//            $upload_path = 'backend/assets/img/customer/';
//            $image_url = $upload_path . $image_full_name;
//            \Intervention\Image\Facades\Image::make($image)->save($upload_path . $image_full_name);
//            $customer->imageUrl= $image_url;
//        }
//        $customer->save();
//
//        return $this->userProfile();
//    }
//
//    public function searchCustomer(Request $request){
//        $customer = User::with('queries')->where('id',$request['customerId'])->first();
//        $response ="<div class='row'>
//                        <div class='col-md-6'>
//Name:". $customer['name']."<br>";
//        $response .="Gender:". $customer->details['gender']."<br>";
//        $response .="Address:". $customer->details['state_of_birth'].",".$customer->details['country_of_birth']."<br>";
//        $response .="Date of Birth:".$customer->details['date_of_birth']."<br>";
//        $response .="Time of Birth:". $customer->details['time_of_birth']."<br></div>";
//        $response .="<div class='col-md-6'>
//                        <img src='". asset($customer->details['imageUrl']) ."' style='height: 150px; width: 150px;'>
//                        </div></div>
//
//
//        ";
//
//        $response .= "<div class='row'>
//                        <div class='col-lg-12 layout-spacing'>
//                           <div class='statbox widget box box-shadow'>
//                                <div id='accordionIcons' class='widget-header'>
//                                     <div class='row'>
//                                        <div class='col-xl-12 col-md-12 col-sm-12 col-12'>
//                                           <h4>Chat History</h4>
//                                        </div>
//                                     </div>
//                                </div>
//                           <div class='widget-content widget-content-area'>";
//
//
//        foreach($customer->queries as $customer_history){
//
//                       if($customer_history->receiver_id == 0 ){
//                           $response .= ' <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
//                                <div class="widget widget-card-one" style="background-color: #fdd5d5;">
//                                    <div class="widget-content">
//                                        <p style="text-align: center;">'.$customer_history->message .'</p>
//                                    </div>
//                                </div>
//
//                            </div>';
//                       } elseif( $customer_history->sender_id == 1){
//                           $response .= '   <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
//                                <div class="widget widget-card-one" style="background-color: #ffffff;">
//                                    <div class="widget-content">
//                                        <p style="text-align: center;">'.$customer_history->message .'</p>
//                                    </div>
//                                </div>
//
//                            </div>';
//                           }
//                        elseif($customer_history->sender_id == $customer->id){
//
////                        {{-- Customer Query --}}
//                            $response .= '<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 layout-spacing">
//                            <div class="widget widget-card-one" style="background-color: #d5e6fd;">
//                                <div class="widget-content">
//
//                                    <div class="media">
//
//                                        <div class="media-body">
//                                            <h6>c. '.\App\User::find($customer_history->sender_id)->name.'</h6>
//                                            <p>'.$customer_history->created_at->format('d-M y H:i').'</p>
//                                        </div>
//                                    </div>
//                                    <p> '.$customer_history->message.'</p>
//
//                                </div>
//                            </div>
//
//                             </div>';
//                        }
//
//
//                       if($customer_history->astrologerQuery != null){
//
//                           if($customer_history->astrologerQuery->astrologer_id != null) {
////                        {{--Translated by Moderator History --}}
//                               $response .= '<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
//                                <div class="widget widget-card-one"  style="background-color: #ddddf3;">
//                                    <div class="widget-content">
//
//                                        <div class="media">
//
//                                            <div class="media-body">
//
//                                                <h6>m. ' . \App\User::find($customer_history->astrologerQuery->moderator_id)->name . '
//                                                </h6>
//                                                <p class="meta-date-time">' . $customer_history->astrologerQuery->created_at->format('d-M y H:i') . '</p>
//
//                                            </div>
//                                        </div>
//
//                                        <p>
//                                            ' . $customer_history->astrologerQuery->transalated_by_moderator . '
//
//
//
//
//                                        </p>
//
//
//                                    </div>
//                                </div>
//
//                            </div>';
//                           }else{
//
//                           if($customer_history->read == 8) {
////                        {{--Clarified --}}
//                               $response .= '<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-3 layout-spacing">
//                                    <div class="widget widget-card-one"  style="background-color: #eff8f7;">
//                                        <div class="widget-content">
//
//                                            <div class="media">
//
//                                                <div class="media-body">';
//                               if (isset($customer_history->astrologerQuery->customer_rating)) {
//                                   $response .= ' <p style="text-align: center;">';
//                                   for ($i = 0; $i < $customer_history->astrologerQuery->customer_rating->rating; $i++) {
//                                       $response .= ' <img src="' . asset('star.png') . '" style="width: 25px; height: 25px;">';
//                                   }
//                                   $response .= '</p>';
//                               } else {
//                                   $response .= $customer_history->astrologerQuery->customer_rating;
//                                   $response .= ' <p style="margin-bottom: 10px;text-align: center;font-size: 0.7em;">Not Rated</p>';
//                               }
//                               $response .= '  <h6>m. ' . \App\User::find($customer_history->astrologerQuery->moderator_id)->name . ' Clarified
//                                                    </h6>';
//                               $response .= ' <p class="meta-date-time">' . $customer_history->astrologerQuery->created_at->format('d-M y H:i') . '</p>
//
//                                                        </div>
//                                                    </div>
//
//                                                    <p>'.$customer_history->astrologerQuery->transalated_by_moderator.'
//                                            </p>
//
//
//                                        </div>
//                                    </div>
//
//                                </div>';
//                           }else{
////                                {{--Moderator as Psychologist --}}
//                               $response .= ' <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-3 layout-spacing">
//                                <div class="widget widget-card-one"  style="background-color: #eff8f7;">
//                                    <div class="widget-content">
//                                        <div class="media">
//                                            <div class="media-body">
//                                           .';
//                               if(isset($customer_history->astrologerQuery->customer_rating)){
//                                   $response .= '<p style="text-align: center;">';
//                                               for($i=0; $i<$customer_history->astrologerQuery->customer_rating->rating; $i++){
//                                                   $response .= '<img src="'.asset('star.png').'" style="width: 25px; height: 25px;">';
//                                               }
//                                   $response .= ' </p>';
//                               }else{
//                                    $response .= $customer_history->astrologerQuery->customer_rating;
//                                    $response .=  '<p style="margin-bottom: 10px;text-align: center;font-size: 0.7em;">Not Rated</p>';
//                               }
//                               $response .= '<h6>m. '.\App\User::find($customer_history->astrologerQuery->moderator_id)->name.' as Pyshologist </h6>
//                                                <p class="meta-date-time">'.$customer_history->astrologerQuery->created_at->format('d-M y H:i').'</p>
//
//                                            </div>
//                                        </div>
//
//                                        <p>
//                                        </p>
//
//
//                                    </div></div>
//
//                            </div>';
//                            }
//                           }
//                       if(isset($customer_history->astrologerQuery->astrologer_id )) {
//
//                           if (isset($customer_history->astrologerQuery->revertedQuery)) {
//                               foreach ($customer_history->astrologerQuery->revertedQuery as $reverted) {
//
//                                   if (isset($reverted->astrologer_answer)) {
//                                       $response .= '<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
//                                        <div class="widget widget-card-one" style="background-color: #eff8f7;
//                                                box-shadow: 0 10px 20px -10px #e6ab05;">
//                                            <div class="widget-content">
//
//                                                <div class="media">
//
//                                                    <div class="media-body">
//
//                                                        <h6>a. ' . \App\User::find($reverted->astrologer_id)->name . '</h6>
//                                                        <p>' . $reverted->created_at->format('d-M y H:i') . '</p>
//
//                                                    </div>
//                                                </div>
//                                                <p>' . $reverted->astrologer_answer . '</p>
//
//                                            </div>
//                                        </div>
//
//                                    </div>';
//                                   }
//                                   if (isset($reverted->moderator_reply)) {
//                                       $response .= '<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
//                                             <div class="widget widget-card-one" style="background-color: #ddddf3;">
//                                                 <div class="widget-content">
//
//                                                     <div class="media">
//
//                                                         <div class="media-body">
//
//                                                             <h6>m. ' . \App\User::find($reverted->moderator_id)->name.'</h6>
//                                                             <p>' . $reverted->updated_at->format('d-M y H:i').'</p>
//
//                                                         </div>
//                                                     </div>
//                                                     <p>' . $reverted->moderator_reply.'</p>
//
//                                                 </div>
//                                             </div>
//
//                                         </div>';
//                                }
//                               }
//                           }
////                    {{--                     Answered By Astrologer History --}}
//
//
//                           if($customer_history->astrologerQuery->translated_answer == null && $customer_history->astrologerQuery->astrologer_id != null){
////        {{-- Astrologer Answer --}}
//                           $response .= '  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-2 layout-spacing">
//                                <div class="widget widget-card-one"  style="background-color: #f3eede;">
//                                    <div class="widget-content">
//
//                                        <div class="media">
//
//                                            <div class="media-body">
//                                                <h6>a. '.\App\User::find($customer_history->astrologerQuery->astrologer_id)->name.'
//                                                </h6>
//                                                <p class="meta-date-time">'.$customer_history->astrologerQuery->updated_at->format('d-M y H:i').'</p>
//
//                                            </div>
//                                        </div>
//
//                                        <p style="margin-bottom: 10px;">
//
//                                            '.$customer_history->astrologerQuery->astrologer_answer.'</p>
//
//
//
//
//
//
//                                    </div>
//                                </div>
//
//                            </div>';
//
//      }elseif($customer_history->read != 8 && $customer_history->read != 11){
////        {{-- Moderator to Customer --}}
//                       $response .= '<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-3 layout-spacing">
//                                    <div class="widget widget-card-one" style="background-color: #eff8f7;">
//                                        <div class="widget-content">
//
//                                            <div class="media">
//
//                                                <div class="media-body">';
//                        if(isset($customer_history->astrologerQuery->customer_rating)){
//                            $response .= '   <p style="text-align: center;">';
//                       for($i=0; $i<$customer_history->astrologerQuery->customer_rating->rating; $i++){
//                           $response .= '<img src="'.asset('star.png').'" style="width: 25px; height: 25px;">';
//                       }
//                            $response .= '</p>';
//                  } else{
//                            $response .= $customer_history->astrologerQuery->customer_rating.'
//                                                        <p style="margin-bottom: 10px;text-align: center;font-size: 0.7em;">Not Rated</p>';
//                   }
//                               $response .= '<h6>m. '.\App\User::find($customer_history->astrologerQuery->moderator_id)->name.'</h6>
//                                                <p>'.$customer_history->astrologerQuery->updated_at->format('d-M y H:i').'</p>
//
//                                        </div>
//                                    </div>
//                                    <p>'.$customer_history->astrologerQuery->translated_answer.'</p>
//
//                            </div>
//              </div>
//                        </div>';
//
//               }
//                       }
//        }
//        }
//
//        $response .= "
//                        </div>
//                        </div>";
//
//        return $response;
//
//    }
//    public function userProfile(){
//
//
//        return view('customer.profile');
//    }
//
//}
