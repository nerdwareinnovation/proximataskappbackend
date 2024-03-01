<?php

namespace App\Http\Controllers\Astrology\Customer;

use App\Models\Astrology\AstrologerQuery;
use App\Models\Astrology\Chat;
use App\Models\Astrology\CustomerDetails;
use App\Models\Astrology\CustomerPackage;
use App\Http\Resources\ChatResource;
use App\Models\Astrology\Package;
use App\Models\Astrology\SampleQuestionsCategory;
use App\Models\Astrology\Transaction;
use App\Models\User;
use App\Models\Astrology\CustomerRating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(Request $request){
        $this->middleware(function ($request, $next) {
//            $this->user= Auth::user();
//            dd($this->user);
            if(auth()->user()->details->date_of_birth == null || Auth()->user()->details->country_of_birth == null || Auth()->user()->details->city_of_birth == null || Auth()->user()->details->state_of_birth == null || Auth()->user()->details->gender == null || Auth()->user()->details->time_of_birth == null){
                return redirect(route('customer.editProfile'));
            }
            return $next($request);
        });

    }
    public function index(){

        $conversationByDate = Chat::with('rating')->where('receiver_id','!=',0)->where('sender_id','=',Auth::user()->id )->orWhere('receiver_id','=',Auth::user()->id)->get()->groupBy(function($query){
            return $query->created_at->format('Y-m-d');
        });

        $questions = SampleQuestionsCategory::with('questions')->get();
        return view('customer.dashboard')->with(compact('conversationByDate','questions'));
    }
    public function packages(){
        $packages = Package::all();
        return view('customer.packages')->with(compact('packages'));
    }

    public function transactions(){
        $transactions = Transaction::where('customer_id','=',auth()->user()->id)->latest()->get();
        return view('customer.transactions')->with(compact('transactions'));
    }

    public function rateAstrologer(Request $request){
  return redirect()->route('customer.dashboard')->with('message', "Query Rated Successfully.") ;

        $validated = $request->validate([

            'rating' => 'required',
            'chat_id' => 'required',


        ]);

        if(CustomerRating::where('chat_id','=',$request['chat_id'])->exists()){
            echo CustomerRating::where('chat_id','=',$request['chat_id'])->exists();
            echo $request['chat_id'];
            die;
            $rate = CustomerRating::where('chat_id','=',$request['chat_id'])->first();

            $rate->rating = $request['rating'];
            $rate->chat_id = $request['chat_id'];
            $rate->customer_id = auth()->user()->id;
            $rate->save();


        }
        else{

            $rate = new CustomerRating();
            $rate->rating = $request['rating'];
            $rate->chat_id = $request['chat_id'];
            $rate->customer_id = auth()->user()->id;
            $rate->save();
        }



    }

    public function sendMessage(Request $request){
        $customer_package =CustomerPackage::where( 'customer_id', auth()->user()->id)->first();
        $left_ques = $customer_package->question_left ;
        if ($left_ques > 0) {
            $customer_package->question_left = $left_ques - 1;
            $customer_package->save();
            $request->json()->all();
            $customer_details =CustomerDetails::where( 'user_id', auth()->user()->id)->first();
            $question_asked=$customer_details->question_asked + 1;
            $customer_details->question_asked = $question_asked;
            $customer_details->save();

            $message = new Chat;
            $message->message = $request['message'];
            $message->read = 0;
            $message->sender_id = auth()->user()->id;

            $moderators = User::all()->where('role_id','=','4')->where('status',1);
            $moderator_count = 0;
            $sender = auth()->user()->id;
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

//        $conversation = $message->conversation;

            //   $user = User::findOrFail($conversation->sender_id == auth()->id() ? $conversation->sender_id: $conversation->receiver_id);
            //$user->pushNotification(auth()->user()->name.' send you a message',$message->message,$message);
            return redirect()->route('customer.dashboard')->with('message', "Question has been sent to astrologer.") ;
        }
        else{

            return redirect()->route('customer.packages')->with('message', "Question Limit has Reached. Please buy Packages to ask more question.") ;

        }
    }



}
