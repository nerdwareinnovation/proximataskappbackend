<?php

namespace App\Http\Controllers\Psychologist;

use App\AstrologerQuery;
use App\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PsychologistController extends Controller
{

    public function sendAnswerToCustomer(Request $request){

        $validated = $request->validate([
            'astrologer_query_id' => 'required',
            'customer_id' => 'required',
            'message' => 'required',
        ]);
        $psychologist_id = Auth::user()->id;
        $past_messages = Chat::all()->where('sender_id','=',$psychologist_id);
        if($past_messages == null){
        foreach ($past_messages as $pm){
            $percentage = 0;
            (similar_text($request['message'],$pm->message,$percentage));
            if ($percentage > 90){
                break;
            }
        }
        }
        else{
            $percentage = 0;
        }


        if ($percentage < 90){

            $chat = new Chat();
            $chat->sender_id = $psychologist_id;
            $chat->message = $request['message'];
            $chat->receiver_id = $request['customer_id'];
            $chat->read = 0;
            $chat->save();

            $astrologerQuery = AstrologerQuery::find($request['astrologer_query_id']);
            $astrologerQuery->translated_answer=$request['message'];
            $astrologerQuery->save();
            $markasread = Chat::find($astrologerQuery->chat_id);
            $markasread->read = 2;
            $markasread->save();

            return response()->json(['success'=>'Message sent to Customer Successfully']) ;

        }
        else{
            return response()->json(['failed'=>'Duplicate Message!']);
        }

    }

}
