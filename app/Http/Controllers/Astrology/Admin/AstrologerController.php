<?php

namespace App\Http\Controllers\Astrology\Admin;

use App\Models\Astrology\AstrologerDetails;
use App\Models\Astrology\AstrologerQuery;
use App\Models\Astrology\PostponeTask;
use App\Models\Astrology\Chat;
use App\Models\Astrology\CustomerDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AstrologerController extends Controller
{
    public function assignToAstrologer(Request $request){

        $validated = $request->validate([
            'chat_id' => 'required',
            'moderator_id' => 'required',
            'message' => 'required',
        ]);
        $markasread = Chat::find($request['chat_id']);
        $sender = $markasread->sender_id;
        $astrologerQuery = new AstrologerQuery;
        $astrologers = User::all()->where('role_id','=','3')->where('status',1);
        $astrologer_count = 0;
        $filtered_astrologers = $astrologers->filter(function ($item) {
            return $item->isOnline();
        })->values();
        if(count($filtered_astrologers) != 0){
            foreach ($filtered_astrologers as $filters){
                $chats = (AstrologerQuery::with(['chat' => function($q) use($sender){
                    $q->where('chats.sender_id', '=', $sender);
                }])->where('astrologer_id','=',$filters->id)->get());
                if($astrologer_count < count($chats)){
                    $astrologer = $filters;
                }
                $astrologer_count = count($chats);

            }
        }
        else{
            $astrologer = $astrologers->random();
        }

        $astrologerQuery->astrologer_id = $astrologer->id;
        $astrologerQuery->chat_id = $request['chat_id'];
        $astrologerQuery->moderator_id = $request['moderator_id'];
        $astrologerQuery->transalated_by_moderator = $request['message'];
        $astrologerQuery->moderated_at = Carbon::now();
        $astrologerQuery->save();


        $markasread->read = 1;
        $markasread->save();


        return response()->json(['success'=>'Message sent to astrologer Successfully']);
    }

    public function sendAnswerToCustomer(Request $request){

        $validated = $request->validate([
            'astrologer_query_id' => 'required',
            'customer_id' => 'required',
            'moderator_id' => 'required',
            'message' => 'required',
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

            $chat = new Chat();
            $chat->sender_id = $request['moderator_id'];
            $chat->message = $request['message'];
            $chat->receiver_id = $request['customer_id'];
            $chat->read = 0;
            $chat->save();

            $astrologerQuery = AstrologerQuery::find($request['astrologer_query_id']);
            $astrologerQuery->translated_answer=$request['message'];
            $astrologerQuery->reply_id = $chat->id;
            $astrologerQuery->save();

            $chat_update = Chat::find($astrologerQuery->chat_id);
            $chat_update->read = 2;
            $chat_update->save();

             $firebaseToken = CustomerDetails::where('user_id','=', $request['customer_id'])->pluck('fcm_token')->all();
                        $SERVER_API_KEY = 'AAAA6jYsBh8:APA91bGQQ96JLORhjSQ2pSBIIojjGhAiXzdELNthkVr_NgGSTbdqgXWnZDPOwBlDW4waNAgESOZ80-J3pmHRjHCYk-AFFUC8R6piz6r4-4u_BSw59rTvkg-aFuCToo01OhoQhr7jtEj9';

                        $data = [
                            "registration_ids" => $firebaseToken,
                            "notification" => [
                                "title" => "Your Query Has Been Answered",
                                "body" => $request['message'],
                            ]
                        ];
                        $dataString = json_encode($data);

                        $headers = [
                            'Authorization: key=' . $SERVER_API_KEY,
                            'Content-Type: application/json',
                        ];

                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

                        $response = curl_exec($ch);


                    return response()->json(['success'=>'Answered to Customer!']);


        }
        else{
            return response()->json(['failed'=>'Message Similar to Previous Message!']);
        }

    }
    public function addNewAstrologer(){
        return view('admin.addNewAstrologer');
    }
    public function editAstrologer(Request $request,$id){
        $user = User::find($id);
        return view('astro.admin.editAstrologer')->with(compact('user'));
    }
    public function updateAstrologer(Request $request,$id){
        $user = User::find($id);
        $user->name=$request['name'];
        $user->email=$request['email'];
        $astrologer_details = AstrologerDetails::where('user_id',$id)->first();
        $astrologer_details->designation = $request['designation'];
        $image = $request->file('image');
        if ($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'backend/assets/img/astrologer/';
            $image_url = $upload_path . $image_full_name;
            \Intervention\Image\Facades\Image::make($image)->save($upload_path . $image_full_name);
            $astrologer_details->image_url= $image_url;
        }
        $astrologer_details->mac_address = $request['mac_address'];
        $astrologer_details->save();

        return redirect()->route('admin.astrologers');
    }
    public function storeAstrologer(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'designation' => 'required',
        ]);
        $user = new User();
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->role_id=3;
        $user->password=bcrypt($request['password']);
        $user->save();
        $astrologer_details = new AstrologerDetails();
        $astrologer_details->designation = $request['designation'];
        $astrologer_details->user_id = $user->id;
        $image = $request->file('image');
        if ($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'backend/assets/img/astrologer/';
            $image_url = $upload_path . $image_full_name;
            \Intervention\Image\Facades\Image::make($image)->save($upload_path . $image_full_name);
            $astrologer_details->image_url= $image_url;
        }
        $astrologer_details->save();
        return redirect()->route('admin.astrologers');
    }
    public function storeCustomerNotes(Request $request){
        $validated = $request->validate([
            'notes' => 'required',
            'customer_id' => 'required',
        ]);

        $customer_details = CustomerDetails::where('user_id','=',$request['customer_id'])->first();

        $customer_details->notes=$request['notes'];


        $customer_details->save();

        return response()->json(['success'=>'Notes Saved Successfully']);
    }
    public function filterAstrologer(Request $request){
        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $start = Carbon::parse($request->from_date);
        $end = Carbon::parse($request->to_date);

        $astrologers = User::where('role_id','3')->whereDate('created_at','<=',$end)
            ->whereDate('created_at','>=',$start)->get();
        return view('astro.admin.astrologerList')->with(compact('astrologers','start','end'));

    }
    public function astrologerKPI(Request $request,$id){
        $user = User::find($id);
        $data['questions_answered'] =Chat::whereHas('astrologerQuery',function ($query) use($id){
            $query->where('astrologer_id',$id);
        })->where('read',2)->count();
        $data['questions_postponed'] = PostponeTask::where('user_id',$id)->count();
        $data['astrologer_name'] = $user->name;
        $rating = AstrologerQuery::with('customer_rating')->where('astrologer_id',$id)->get();


        $data['rating'] =  round($rating->avg('customer_rating.rating'),2);
        $data['total_raters_count'] = count($rating);
        return view('astro.admin.astrologerKPIDetails')->with($data);
    }
}
