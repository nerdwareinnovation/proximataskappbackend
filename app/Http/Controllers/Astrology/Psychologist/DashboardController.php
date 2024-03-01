<?php

namespace App\Http\Controllers\Psychologist;

use App\AstrologerQuery;
use App\Chat;
use App\FilterWords;
use App\SampleQuestionsCategory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $messages = AstrologerQuery::with('chat')->where('astrologer_id','=',auth()->user()->id)->where('translated_answer','=',null)->get();
        $t_p_m = AstrologerQuery::all()->where('translated_answer','=','')->where('astrologer_id','=',auth()->user()->id);
        $total_pending_messages = count($t_p_m);
        return view('psychologist.dashboard')->with(compact('messages','t_p_m','total_pending_messages'));

    }
    public function queryScreen($id){
        $messages = Chat::find($id);
        $customer = $messages->sender;
        $questions = SampleQuestionsCategory::with('questions')->whereHas('questions', function($q)
        {
            $q->where('role', '=', 2);

        })->get();

        $astrologerDetails = User::with('astrologerDetails')->where('role_id',3)->get();
        $restricted_words = FilterWords::all();

        return view('psychologist.queryScreen')->with(compact('restricted_words','customer','messages','astrologerDetails','questions'));
    }
    public function queryList(){
        $messages = AstrologerQuery::with('chat')->where('astrologer_id','=',auth()->user()->id)->get();


        return view('psychologist.queryList')->with(compact('messages'));
    }
}
