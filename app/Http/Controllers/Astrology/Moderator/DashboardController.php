<?php

namespace App\Http\Controllers\Astrology\Moderator;
use DB;
use App\AstrologerQuery;
use App\AstrologerRating;
use App\PinnedMessage;
use App\Chat;
use App\BackToMod;
use App\CustomerNotes;
use App\PostponeTask;
use App\SampleQuestionsCategory;
use App\CustomerPackage;
use App\User;
use App\CustomerDetails;
use App\FilterWords;
use App\SampleQuestionsCategoryModerator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){



        $messages =Chat::with('astrologerQuery')->where('receiver_id','=',Auth::user()->id)->whereNotIn('read',array(2,8,11))->latest('created_at')->limit(5)->get();
        $total_messages = Count(Chat::all()->where('receiver_id','=',Auth::user()->id));
        $sent_to_astrologer_count = Count(Chat::where('receiver_id','=',Auth::user()->id)->where('read','=','1')->get());
        $answered_count = Count(Chat::where('receiver_id','=',Auth::user()->id)->where('read','=','2')->get());
        $total_pending_messages = count(Chat::all()->where('moderator_id','=',Auth::user()->id));
        return view('moderator.dashboard')->with(compact('messages','sent_to_astrologer_count','answered_count'));

    }
    public function postponeQuestion($id){
           $messages = Chat::find($id);

            $postponed = new PostponeTask();
            $postponed->chat_id = $messages->id;
            $postponed->user_id = Auth::user()->id;
            $postponed->read_status = $messages->read;
            $postponed->save();



           $messages->read = 6;
           $messages->save();
           return redirect()->route('moderator.getNewTask');
    }
    public function getNewTask(){

        $messages = Chat::where('receiver_id','=',Auth::user()->id)->where('sender_id','!=',1)->whereNotIn('read',array(1,2,4,6,8,11))->get();
        $pinnedMessages = PinnedMessage::where('pinned_by',Auth::user()->id)->latest()->get();

        foreach ($messages as $message){

            $history = Chat::where('sender_id','=',$message->sender_id)->where('receiver_id','!=',0)->where('created_at','<',$message->created_at)->get();


            if(count($history) != 0){

            foreach($history as $h => $item){

               if($item->read != 2 AND $item->read != 8 AND $item->read != 11){

                $messages = $messages->filter(function($q) use($item){
                   return $q->sender_id != $item->sender_id;

                    });



                }



            }

            $messages = $messages->first();
            break;

            }
            else{

                $messages = $messages->where('id','=',$message->id)->first();
                break;
            }
        }

//         dd($messages);
//         dd($messages);

        if(isset($messages)){
        if(($messages)->count() != 0){


                $customer = $messages->sender;
                $deviceId = @$messages->sender->details->deviceId;

            $similar_customers=null;
                if(isset($deviceId)){
                      $similar_customers =  User::where('role_id','=',2)->whereHas('details', function($q) use($deviceId)
                             {
                                 $q->where('deviceId', '=', $deviceId );

                             })->where('id','!=',$messages->sender->id)->get();




                }



                $cus_messages = Chat::with('astrologerQuery','rating')->where('sender_id','=',$customer->id)->orWhere('sender_id','=',0)->orWhere('receiver_id',$customer->id)->get();
                $customer_notes =  CustomerNotes::where('customer_id','=',$customer->id)->get();
                $questions = SampleQuestionsCategoryModerator::with('questions')->get();
                $astrologerDetails = User::with('astrologerDetails')->where('role_id',3)->get();
                $restrictedWords = FilterWords::all();

            return view('moderator.queryScreen')->with(compact('messages','customer','questions','astrologerDetails','cus_messages','customer_notes','restrictedWords','pinnedMessages','similar_customers'));
        }
        else{
            $response = "Dear m. ".Auth::user()->name.", Unfortunately, there are no tasks to perform yet. You have been accounted work units before, so please try again in 5 minutes to get a task. ";
          return redirect()->route('moderator.dashboard')->with('message', $response);
        }
        }
        else{
                    $response = "Dear m. ".Auth::user()->name.", Unfortunately, there are no tasks to perform yet. You have been accounted work units before, so please try again in 5 minutes to get a task. ";
                  return redirect()->route('moderator.dashboard')->with('message', $response);
                }

}

    public function backToAstrologer(Request $request){


                $validated = $request->validate([
                    'reverted_id' => 'required',
                    'message' => 'required',
                    'chat_id'=>'required'

                ]);

                $markasread = Chat::find($request['chat_id']);
                $markasread->read = 1;
                $markasread->save();

                $backtomod = BackToMod::find($request['reverted_id']);
                $backtomod->moderator_id = Auth::user()->id;
                $backtomod->moderator_reply = $request['message'];
                $backtomod->save();



                return response()->json(['success'=>'Message sent to Moderator Successfully']);


        }
    public function queryScreen($id){
        $cus_messages = Chat::find($id);
        $customer = $messages->sender;
        $message = Chat::with('astrologerQuery')->where('sender_id','=',$customer)->orWhere('receiver_id','=',$customer)->get();

        $questions = SampleQuestionsCategoryModerator::with('questions')->get();


        $astrologerDetails = User::with('astrologerDetails')->where('role_id',3)->get();
        return view('moderator.queryScreen')->with(compact('messages','customer','questions','astrologerDetails'));


    }
    public function queryList(){
         $queries = Chat::with('astrologerQuery')->where('receiver_id','=',Auth::user()->id)->latest('created_at')->get();

         return view('moderator.queryList')->with(compact('queries'));
    }
    public function rateAstrologer(Request $request){
        $validated = $request->validate([
            'rating' => 'required',
            'user_id' => 'required',
            'astrologer_id' => 'required',
            'query_id' => 'required',
        ]);
        $rating = new AstrologerRating;
        $rating->rating = $request['rating'];
        $rating->user_id = $request['user_id'];
        $rating->astrologer_id = $request['astrologer_id'];
        $rating->query_id = $request['query_id'];
        $rating->save();
        return response()->json(['success'=>'Astrologer Rated Successfully']);
    }

     public function clarifyQuestionToCustomer(Request $request){

            $validated = $request->validate([
                'chat_id' => 'required',
                'moderator_id' => 'required',
                'message' => 'required',
                'customer_id' => 'required'
            ]);

            $chat = new Chat();
            $chat->sender_id = $request['moderator_id'];
            $chat->message = $request['message'];
            $chat->receiver_id = $request['customer_id'];
            $chat->read = 8;
            $chat->save();

             $old_chat = Chat::where('id',$request['chat_id'])->first();
             $old_chat->read = 8;
             $old_chat->save();
            $customer = CustomerPackage::where('customer_id',$request['customer_id'])->first();


            $customer->question_left = $customer->question_left + 1;
            $customer->save();


            $astrologerQuery = AstrologerQuery::where('chat_id',$request['chat_id'])->first();
            if (!isset($astrologerQuery)){
            $astrologerQuery = new AstrologerQuery();
            $astrologerQuery->transalated_by_moderator = $request['message'];
            $astrologerQuery->chat_id = $request['chat_id'];
             $astrologerQuery->reply_id = $chat->id;
            $astrologerQuery->moderator_id = $request['moderator_id'];
            $astrologerQuery->translated_answer=$request['message'];
            $astrologerQuery->save();
            }
            else{
                $astrologerQuery->reply_id = $chat->id;
                $astrologerQuery->moderator_id = $request['moderator_id'];
                $astrologerQuery->translated_answer=$request['message'];
                $astrologerQuery->save();
            }
             $notification['message_title']="Your Query Has Been Clarified";
             $notification['message_text']=$request['message_text'];
            $firebaseToken = CustomerDetails::where('user_id','=', $request['customer_id'])->pluck('fcm_token')->all();
             send_push_notification($firebaseToken,$notification);
//            $SERVER_API_KEY = 'AAAA6jYsBh8:APA91bGQQ96JLORhjSQ2pSBIIojjGhAiXzdELNthkVr_NgGSTbdqgXWnZDPOwBlDW4waNAgESOZ80-J3pmHRjHCYk-AFFUC8R6piz6r4-4u_BSw59rTvkg-aFuCToo01OhoQhr7jtEj9';
//
//            $data = [
//                "registration_ids" => $firebaseToken,
//                "notification" => [
//                    "title" => "Your Query Has Been Clarified",
//                    "body" => $request['message'],
//                ]
//            ];
//            $dataString = json_encode($data);
//
//            $headers = [
//                'Authorization: key=' . $SERVER_API_KEY,
//                'Content-Type: application/json',
//            ];
//
//            $ch = curl_init();
//
//            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
//            curl_setopt($ch, CURLOPT_POST, true);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
//
//            $response = curl_exec($ch);

            return response()->json(['success'=>'Answer Clarified Successfully']) ;

        }
    public function sendAnswerToCustomerAsPsychologist(Request $request){

        $validated = $request->validate([
            'chat_id' => 'required',
            'moderator_id' => 'required',
            'message' => 'required',
            'customer_id' => 'required'
        ]);
        $past_messages = Chat::all()->where('sender_id','=',$request['moderator_id'])->where('receiver_id','=',$request['customer_id']);
           if (count($past_messages) == 0){
              $percentage=0;
            }
            else{
                foreach ($past_messages as $pm){
                    $percentage = 0;
                    (similar_text($request['message'],$pm->message,$percentage));
                    if ($percentage > 90){
                        break;
                    }
                }
            }




                if ($percentage < 90){
                    $chat_read = Chat::find($request['chat_id']);
                     $chat_read->read = 11;
                     $chat_read->save();

                    $chat = new Chat();
                    $chat->sender_id = $request['moderator_id'];
                    $chat->message = $request['message'];
                    $chat->receiver_id = $request['customer_id'];
                    $chat->read = 0;
                    $chat->save();

                    $astrologerQuery = new AstrologerQuery();
                    $astrologerQuery->transalated_by_moderator = $request['message'];
                    $astrologerQuery->chat_id = $request['chat_id'];
                    $astrologerQuery->reply_id = $chat->id;
                    $astrologerQuery->moderator_id = $request['moderator_id'];
                    $astrologerQuery->translated_answer=$request['message'];
                    $astrologerQuery->save();

                    $notification['message_title']="Your Query Has Been Answered";
                    $notification['message_text']=$request['message'];
                    $firebaseToken = CustomerDetails::where('user_id','=', $request['customer_id'])->pluck('fcm_token')->all();
                    send_push_notification($firebaseToken,$notification);



                    return response()->json(['success'=>'Message sent to Customer Successfully']) ;

                }
                else{
                    return response()->json(['failed'=>'Duplicate Message!']);
                }
    }
    public function pinMessage(Request $request){
        $data = $request->except('_token');
        if ($data['message_type'] == 'system'){
            $system_message = Chat::find($data['message']);
            $data['message'] = $system_message->message;
        }
        elseif($data['message_type']=='customer'){
            $message = Chat::find($data['message']);
            $data['message'] = $message->message;
        }
        elseif($data['message_type']=='modtocustomer' || $data['message_type']=='modclarified'  ){
            $message = AstrologerQuery::find($data['message']);
            $data['message'] = $message->translated_answer;
        }
        elseif($data['message_type']=='astroans'){
            $message = AstrologerQuery::find($data['message']);
            $data['message'] = $message->astrologer_answer;
        }
        elseif($data['message_type']=='modtoastro'){
            $message = AstrologerQuery::find($data['message']);
            $data['message'] = $message->transalated_by_moderator;
        }
        elseif($data['message_type']=='revertedastroans'){
            $message = BackToMod::find($data['message']);
            $data['message'] = $message->astrologer_answer;
        }
        elseif($data['message_type']=='revertedmodtoastro'){
            $message = BackToMod::find($data['message']);
            $data['message'] = $message->moderator_reply;
        }
        $pinned_message = PinnedMessage::create($data);
        $pinned_message->sender = User::find($pinned_message->sender_id);
        return response()->json($pinned_message);
    }
    public function unpinMessage(Request $request){
        $pinned_message = PinnedMessage::find($request->id)->delete();
        return response()->json('Successfull');
    }

    }


