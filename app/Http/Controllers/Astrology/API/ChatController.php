<?php

namespace App\Http\Controllers\Astrology\API;

use App\Models\Astrology\AstrologerQuery;
use App\Models\Astrology\Chat;
use App\Models\Astrology\Conversation;
use App\Models\Astrology\CustomerPackage;
use App\Models\Astrology\CustomerRating;
use App\Models\Astrology\CustomerDetails;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeMessageRequest;
use App\Http\Resources\ChatResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rateQuery(Request $request)
    {
          $request->json()->all();
          $rating = new CustomerRating;
          $rating->chat_id = $request['chat_id'];
          $rating->rating = $request['rating'];
          $rating->customer_id =auth()->user()->id;
          $rating->save();
          return response()->json([
                'success' => true,
                'message' => 'Query Rated Successfully',
            ], 201);
    }

         public function updateRating(Request $request)
            {
                  $request->json()->all();
                  $rating = CustomerRating::where('chat_id','=',$request['chat_id'])->first();
                  $rating->rating = $request['rating'];
                  $rating->save();
                  return response()->json([
                        'success' => true,
                        'message' => 'Query Rated Successfully',
                    ], 201);
            }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer_package =CustomerPackage::where( 'customer_id', auth()->user()->id)->first();
        $checkFirst = Chat::where('sender_id',auth('api')->user()->id)->where('receiver_id',
            '!=',0)->count() == 0;
        $left_ques = $customer_package->question_left ;
        $customer_details =CustomerDetails::where( 'user_id', auth()->user()->id)->first();
        if ($customer_details->country_of_birth != null && $customer_details->date_of_birth != null && $customer_details->time_of_birth != null){
        if ($left_ques > 0) {

        $request->json()->all();
        $question_asked=$customer_details->question_asked+1;
        $customer_details->question_asked = $question_asked;
         $customer_details->save();

        $message = new Chat;
        $message->message = $request['message'];
        $message->read = 0;
        $message->sender_id = auth()->user()->id;
        $sender = auth()->user()->id;
        $moderators = User::all()->role('moderator')->where('status',1);
        $moderator_count = 0;
        $filtered_moderators = $moderators->filter(function ($item) {
            return $item->isOnline();
        })->values();
        if(count($filtered_moderators) != 0){
            foreach ($filtered_moderators as $filters){
                $chats = (AstrologerQuery::with(['chat' => function($q) use($sender){
                    $q->where('chats.sender_id', '=', $sender);
                }])->where('moderator_id','=',$filters->id)->get());
                if($moderator_count < count($chats)){
                    $moderator = $filters;

                }
                $moderator_count = count($chats);

            }
        }
        else{
            $moderator = $moderators->random();
        }


        $message->receiver_id = $moderator->id;

        $message->save();
        $customer_package->question_left = $left_ques - 1;
        $customer_package->save();
        if ($checkFirst){
            $message_first = new Chat;
            $message_first->receiver_id = auth('api')->user()->id;
            $message_first->sender_id = 1;
            $message_first->read = 0;
            $message_first->message = "Thank you for your query. We have received your question and we appreciate your interest in our service. Your query is important to us and we will do our best to answer it as soon as possible. Our team is currently working on your request and we will get back to you with an answer as soon as we can. We aim to provide a response within 12 hours, but please note that response times may vary depending on the volume of inquiries we receive. In the meantime, please feel free to explore our app and its features. If you have any further questions or concerns, please don't hesitate to reach out to us.
Thank you for your patience and understanding.
Best regards,
Disciple Karma Shakya";
            $message_first->created_at = Carbon::now()->addMinutes(1);

            $message_first->save();
        }
//        $conversation = $message->conversation;

     //   $user = User::findOrFail($conversation->sender_id == auth()->id() ? $conversation->sender_id: $conversation->receiver_id);
        //$user->pushNotification(auth()->user()->name.' send you a message',$message->message,$message);
            return new ChatResource($message);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'No Questions Left',
            ], 401);
        }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Please fill birth details first.',
            ], 401);
        }



    }

    public function storeTemplateMessage(Request $request)
    {
        $customer_package = CustomerPackage::where('customer_id', auth()->user()->id)->first();

        $left_ques = $customer_package->question_left;
        $customer_details = CustomerDetails::where('user_id', auth()->user()->id)->first();

        if ($customer_details->country_of_birth != null && $customer_details->date_of_birth != null && $customer_details->time_of_birth != null) {

            if ($left_ques > 0) {
                $customer_package->question_left = $left_ques - 1;
                $customer_package->save();
                $request->json()->all();
                $question_asked = $customer_details->question_asked + 1;
                $customer_details->question_asked = $question_asked;


                $message = new Chat;
                $message->message = $request['message'];
                $message->read = 0;
                $message->sender_id = auth()->user()->id;

                $moderators = User::all()->where('role_id', '=', '4')->where('status', 1);
                $moderator_count = 0;
                $filtered_moderators = $moderators->filter(function ($item) {
                    return $item->isOnline();
                })->values();
                if (count($filtered_moderators) != 0) {
                    foreach ($filtered_moderators as $filters) {
                        $chats = (AstrologerQuery::with(['chat' => function ($q) {
                            $q->where('chats.sender_id', '=', 2);
                        }])->where('moderator_id', '=', $filters->id)->get());
                        if ($moderator_count < count($chats)) {
                            $moderator = $filters;

                        }
                        $moderator_count = count($chats);

                    }
                } else {
                    $moderator = $moderators->random();
                }


                $message->receiver_id = $moderator->id;

                $message->save();

                //        $conversation = $message->conversation;

                //   $user = User::findOrFail($conversation->sender_id == auth()->id() ? $conversation->sender_id: $conversation->receiver_id);
                //$user->pushNotification(auth()->user()->name.' send you a message',$message->message,$message);
                return new ChatResource($message);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No Questions Left',
                ], 401);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please fill birth details first.',
            ], 401);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
