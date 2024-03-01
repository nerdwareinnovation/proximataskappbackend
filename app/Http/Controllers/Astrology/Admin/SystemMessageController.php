<?php

namespace App\Http\Controllers\Astrology\Admin;
use App\Models\Astrology\SystemMessage;
use App\Models\Astrology\SystemMessageLog;
use App\Models\Astrology\Chat;
use App\Models\User;
use App\Models\Astrology\CustomerDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemMessageController extends Controller
{
    public function index(){
        $system_messages = SystemMessageLog::all();
        return view('admin.systemMessages.system_message')->with(compact('system_messages'));
    }
    public function sendSystemPrivateMessage(Request $request,$id){
        $customer = User::find($id);
        $message = new Chat;
        $title = 'Proxima Astrology System Message';
        $message->message = $request['message_text'];
        $message->read = 0;
        $message->sender_id = 1;
        $message->receiver_id = $customer->id;
        $message->save();
        $system_message = new SystemMessage;
        $system_message->name_of_message = $title;
        $system_message->message = $request['message_text'];
        $system_message->save();

        $notification['message_title']=$title;
        $notification['message_text']=$request['message_text'];
        $firebaseToken = CustomerDetails::where('user_id','=', $customer->id)->pluck('fcm_token')->all();

        send_push_notification($firebaseToken,$notification);
        return redirect()->back();

    }
    public function sendMessage(Request $request){
        $validated = $request->validate([
                'message_title' => 'required',
               'message_text' => 'required',
               'country' => 'required',
               'vedic_sign' => 'required',
       ]);
//         ($request['country']);
        $selected_country = $request['country'];
        $selected_vedic = $request['vedic_sign'];
        $customer_type = $request['customer_type'];
        if($selected_country == 'default' AND $selected_vedic =='default' AND $customer_type == 'default'){
          $customers = User::where('role_id','=',2)->get();
        }
         elseif($selected_country == 'default'  AND $selected_vedic =='default' AND  $customer_type != 'default'){
            if($customer_type == 'free'){
                 $customers = User::whereHas('details',function ($query){
                    $query->where('question_asked','==',0)->orWhere('question_asked','==',1);
                })->where('role_id','=',2)->get();

            }
            elseif($customer_type == 'silver'){
                 $customers = User::whereHas('details',function ($query)  {
                    $query->where('question_asked','>=',1)->where('question_asked','<=',50);
                })->where('role_id','=',2)->get();

            }
            elseif($customer_type == 'gold'){
                 $customers = User::whereHas('details',function ($query)  {
                    $query->where('question_asked','>=',51)->where('question_asked','<=',99);
                })->where('role_id','=',2)->get();


            }
            elseif($customer_type == 'platinum'){
                $customers = User::whereHas('details',function ($query){
                    $query->where('question_asked','>=',100);
                })->where('role_id','=',2)->get();

            }
         }
        elseif($selected_country == 'default'  AND $selected_vedic !='default'   AND $customer_type == 'default'){
            $customers = User::whereHas('details',function ($query) use($selected_vedic) {
                $query->where('vedic_sign',$selected_vedic);
            })->where('role_id','=',2)->get();


        }
        elseif($selected_country == 'default'  AND $selected_vedic !='default'   AND $customer_type != 'default'){
                   if($customer_type == 'free'){
                                  $customers = User::whereHas('details',function ($query) use($selected_vedic){
                                     $query->where('question_asked','==',0)->orWhere('question_asked','==',1)->where('vedic_sign','=',$selected_vedic);
                                 })->where('role_id','=',2)->get();

                             }
                             elseif($customer_type == 'silver'){
                                  $customers = User::whereHas('details',function ($query) use($selected_vedic) {
                                     $query->where('question_asked','>=',1)->where('question_asked','<=',50)->where('vedic_sign','=',$selected_vedic);
                                 })->where('role_id','=',2)->get();

                             }
                             elseif($customer_type == 'gold'){
                                  $customers = User::whereHas('details',function ($query)  use($selected_vedic)  {
                                     $query->where('question_asked','>=',51)->where('question_asked','<=',99)->where('vedic_sign','=',$selected_vedic);
                                 })->where('role_id','=',2)->get();


                             }
                             elseif($customer_type == 'platinum'){
                                 $customers = User::whereHas('details',function ($query)  use($selected_vedic) {
                                     $query->where('question_asked','>=',100)->where('vedic_sign','=',$selected_vedic);
                                 })->where('role_id','=',2)->get();

                             }


                }
        elseif($selected_country != 'default'  AND $selected_vedic !='default'   AND $customer_type != 'default'){
            if($customer_type == 'free'){
                 $customers = User::whereHas('details',function ($query) use($selected_country,$selected_vedic){
                    $query->where('country_of_birth',$selected_country)->where('vedic_sign',$selected_vedic)->where('question_asked','<=',1);
                })->where('role_id','=',2)->get();


            }
            elseif($customer_type == 'silver'){
                 $customers = User::whereHas('details',function ($query)  use($selected_vedic,$selected_country) {
                    $query->whereBetween('question_asked',[1,50])->where('vedic_sign',$selected_vedic)->where('country_of_birth',$selected_country);
                })->where('role_id','=',2)->get();

            }
            elseif($customer_type == 'gold'){
                 $customers = User::whereHas('details',function ($query)  use($selected_vedic,$selected_country) {
                    $query->where('question_asked','>=',51)->where('vedic_sign',$selected_vedic)->where('question_asked','<=',99)->where('country_of_birth',$selected_country);
                })->where('role_id','=',2)->get();


            }
            elseif($customer_type == 'platinum'){
                $customers = User::whereHas('details',function ($query)  use($selected_vedic,$selected_country) {
                    $query->where('question_asked','>=',100)->where('vedic_sign',$selected_vedic)->where('country_of_birth',$selected_country);
                })->where('role_id','=',2)->get();

            }
                }
        elseif($selected_country != 'default'  AND $selected_vedic =='default'   AND $customer_type != 'default'){
                if($customer_type == 'free'){
                     $customers = User::whereHas('details',function ($query) use($selected_country){
                        $query->where('country_of_birth',$selected_country)->where('question_asked','<=',1);
                    })->where('role_id','=',2)->get();


                }
                elseif($customer_type == 'silver'){
                     $customers = User::whereHas('details',function ($query)  use($selected_vedic,$selected_country) {
                        $query->whereBetween('question_asked',[1,50])->where('country_of_birth',$selected_country);
                    })->where('role_id','=',2)->get();

                }
                elseif($customer_type == 'gold'){
                     $customers = User::whereHas('details',function ($query)  use($selected_vedic,$selected_country) {
                        $query->where('question_asked','>=',51)->where('question_asked','<=',99)->where('country_of_birth',$selected_country);
                    })->where('role_id','=',2)->get();


                }
                elseif($customer_type == 'platinum'){
                    $customers = User::whereHas('details',function ($query)  use($selected_vedic,$selected_country) {
                        $query->where('question_asked','>=',100)->where('country_of_birth',$selected_country);
                    })->where('role_id','=',2)->get();

                }

        }
        elseif($selected_country != 'default' AND $selected_vedic =='default' AND $customer_type =='default'){
            $customers = User::whereHas('details',function ($query) use($selected_country) {
                $query->where('country_of_birth',$selected_country);
            })->where('role_id','=',2)->get();

        }
        elseif($selected_country != 'default' AND $selected_vedic !='default' AND $customer_type =='default'){
            $customers = User::whereHas('details',function ($query) use($selected_country, $selected_vedic) {
                    $query->where('country_of_birth',$selected_country)->where('vedic_sign',$selected_vedic);
                })->where('role_id','=',2)->get();
        }

        foreach($customers as $customer){
                $message = new Chat;
                $message->message = $request['message_text'];
                $message->read = 0;
                $message->sender_id = 1;
                $message->receiver_id = $customer->id;
                $message->save();
                $notification['message_title']=$request['message_title'];
                $notification['message_text']=$request['message_text'];
                $firebaseToken = CustomerDetails::where('user_id','=', $customer->id)->pluck('fcm_token')->all();

                 send_push_notification($firebaseToken,$notification);
//
//
//                 $firebaseToken = CustomerDetails::where('user_id','=', $customer->id)->pluck('fcm_token')->all();
//                $SERVER_API_KEY = 'AAAA6jYsBh8:APA91bGQQ96JLORhjSQ2pSBIIojjGhAiXzdELNthkVr_NgGSTbdqgXWnZDPOwBlDW4waNAgESOZ80-J3pmHRjHCYk-AFFUC8R6piz6r4-4u_BSw59rTvkg-aFuCToo01OhoQhr7jtEj9';
//
//                $data = [
//                    "registration_ids" => $firebaseToken,
//                    "notification" => [
//                        "title" => $request['message_title'],
//                        "body" => $request['message_text'],
//                    ]
//                ];
//                $dataString = json_encode($data);
//
//                $headers = [
//                    'Authorization: key=' . $SERVER_API_KEY,
//                    'Content-Type: application/json',
//                ];
//
//                $ch = curl_init();
//
//                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
//                curl_setopt($ch, CURLOPT_POST, true);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
//
//                $response = curl_exec($ch);
//                print_r($response);



        }
            $system_message = new SystemMessage;
                $system_message->name_of_message = $request['message_title'];
                $system_message->message = $request['message_text'];
                $system_message->save();


        $system_message_log = new SystemMessageLog;
        $system_message_log->message_title = $request['message_title'];
        $system_message_log->country = $request['country'];
        $system_message_log->vedic_sign = $request['vedic_sign'];
        $system_message_log->customers = $request['customer_type'];
        $system_message_log->message = $request['message_text'];
        $system_message_log->save();

        return redirect()->route('admin.systemMessage')->with('message','System Message Sent Successfully') ;


//         $message = new Chat;
//         $message->message = $request['message_text'];
//         $message->read = 0;
//         $message->sender_id = 0;
//         $message->save();
//
//         $system_message = new SystemMessage;
//         $system_message->name_of_message = $request['message_title'];
//         $system_message->message = $request['message_text'];
//         $system_message->chat_id = $message->id;
//         $system_message->save();
//         return redirect()->route('systemMessage')->with('message','System Message Sent Successfully') ;


    }
}
