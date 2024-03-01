<?php

namespace App\Http\Controllers\Astrology\Astrologer;

use App\Models\Astrology\AstrologerDetails;
use App\Models\Astrology\AstrologerQuery;
use App\Models\Astrology\PinnedMessage;
use App\Models\Astrology\BackToMod;
use App\Models\Astrology\Chat;
use App\Models\Astrology\PostponeTask;
use App\Models\Astrology\CustomerDetails;
use App\Models\User;
use App\Models\Astrology\CustomerNotes;
Use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){

        $messages = AstrologerQuery::whereHas('chat',function ($query) {
                           $query->whereNotIn('read',array(2,8,3));
                     })->where('astrologer_id','=',auth()->user()->id)->latest('created_at')->get();

        $t_p_m = AstrologerQuery::all()->where('astrologer_answer','=',null)->where('astrologer_id','=',auth()->user()->id);
        $rating = AstrologerQuery::with('customer_rating')->where('astrologer_id','=',auth()->user()->id)->get();

        $avg_rating= ($rating->avg('customer_rating.rating'));
        $total_raters_count = count($rating);
        $total_pending_messages = count($t_p_m);
        return view('astrologer.dashboard')->with(compact('messages','total_pending_messages','avg_rating','total_raters_count'));

    }

    public function postponeQuestion($id){
               $astro_query_id = AstrologerQuery::find($id)->chat_id;
               $messages = Chat::find($astro_query_id);
               $postponed = new PostponeTask();
               $postponed->chat_id = $astro_query_id;
               $postponed->user_id = Auth::user()->id;
               $postponed->read_status = $messages->read;
               $postponed->save();
               $messages->read = 6;
               $messages->save();
               return redirect()->route('astrologer.getNewTask');
        }

    public function queryScreen($id){
        $messages = AstrologerQuery::find($id);
        $customer = $messages->chat->sender;
        return view('astrologer.answerScreen')->with(compact('messages','customer'));
    }

    public function pendingCustomers(){
        $customers = User::with('details')->where('role_id','=','2')->whereHas('details', function($q)
        {
            $q->where('kundali', '=', null)->orWhere('vedic_sign','=',null);

        })->get();



        return view('astrologer.pendingCustomers')->with(compact('customers'));
    }

     public function getNewTask(){

            $messages = AstrologerQuery::whereHas('chat',function ($query) {
                $query->whereNotIn('read',array(2,5,6,8));
            })->where('astrologer_id','=',auth()->user()->id)->first();

            $pinnedMessages = PinnedMessage::where('pinned_by', \Illuminate\Support\Facades\Auth::user()->id)->latest()->get();


            if(isset($messages)){
            $customer = $messages->chat->sender;
                 $cus_messages = Chat::with('astrologerQuery')->where('sender_id','=',$customer->id)->orWhere('sender_id','=',0)->orWhere('receiver_id',$customer->id)->get();
                 $customer_notes =  CustomerNotes::where('customer_id','=',$customer->id)->get();
                return view('astrologer.answerScreen')->with(compact('messages','cus_messages','customer', 'customer_notes','pinnedMessages'));
            }
            else{
              $response = "Dear a. ".Auth::user()->name.", Unfortunately, there are no tasks to perform yet. You have been accounted work units before, so please try again in 5 minutes to get a task. ";

              return redirect()->route('astrologer.dashboard')->with('message', $response);
            }
         }

    public function updateAnswerModeration(Request $request){
        $validated = $request->validate([
            'astrologer_query_id' => 'required',
            'message' => 'required',
        ]);
        $customer = AstrologerQuery::where('id',$request['astrologer_query_id'])->first();
        $customer->astrologer_answer =  $request['message'];
        $customer->save();
        return response()->json(['success'=>'Customer answer updated!']);

    }
    public function editCustomer($id){
        $customer = User::with('details')->where('id','=',$id)->first();
        return view('astrologer.updateVedic')->with(compact('customer'));
    }
    public function astrologerQuery(){
        $messages = AstrologerQuery::with('chat')->where('astrologer_id','=',auth()->user()->id)->get();

        return view('astrologer.queryList')->with(compact('messages'));
    }

    public function updateCustomerVedicKundali(Request $request){
        $validated = $request->validate([
            'customer_id' => 'required',
            'vedic_sign' => 'required',
        ]);
        $customer = CustomerDetails::where('user_id',$request['customer_id'])->first();
        $customer->vedic_sign = $request['vedic_sign'];
        $image = $request->file('image');
        if ($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'backend/assets/img/customer_kundali/';
            $image_url = $upload_path . $image_full_name;
            \Intervention\Image\Facades\Image::make($image)->save($upload_path . $image_full_name);
            $customer->kundali= $image_url;
        }
        $customer->save();

        return redirect()->back()->with('flash_success', 'Updated Vedic Sign!');
    }
    public function backToModerator(Request $request){


            $validated = $request->validate([
                'astrologer_query_id' => 'required',
                'moderator_id' => 'required',
                'message' => 'required',
                'chat_id' => 'required'

            ]);
            $markasread = Chat::find($request['chat_id']);
            $markasread->read = 3;
            $markasread->save();
            $backToMod = new BackToMod();
            $backToMod->query_id = $request['astrologer_query_id'];
            $backToMod->moderator_id = $request['moderator_id'];
            $backToMod->astrologer_answer = $request['message'];
            $backToMod->astrologer_id = Auth::user()->id;
            $backToMod->astrologer_answer_at = Carbon::now();
            $backToMod->save();
            return response()->json(['success'=>'Message sent to Moderator Successfully']);


    }
    public function sendReplyToModerator(Request $request){
        $validated = $request->validate([
            'astrologer_query_id' => 'required',
            'chat_id' => 'required',
            'message' => 'required',

        ]);
        $markasread = Chat::find($request['chat_id']);
        $markasread->read = 5;
        $markasread->save();



        $astrologerQuery = AstrologerQuery::find($request['astrologer_query_id']);
        if (!isset($astrologerQuery->astrologer_answer)){
            $astrologerQuery->astrologer_answer=$request['message'];
            $astrologerQuery->astrologer_answer_at=Carbon::now();
            $astrologerQuery->save();

            $astrologer = AstrologerDetails::find(auth()->user()->astrologerDetails->id);

            $astrologer->total_question_answered = $astrologer->total_question_answered+1;
            $astrologer->save();
            return response()->json(['success'=>'Message sent to Moderator Successfully']);
        }
        else{
            return response()->json(['failed'=>'Cannot send multiple answers.']);
        }



    }

}
