<?php


namespace App\Http\Controllers\Astrology\API;

use App\Models\Astrology\Chat;
use App\Models\Astrology\Conversation;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Http\Resources\ConversationResource;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $conversations = Conversation::where('receiver_id',auth('api')->user()->id)->orWhere('sender_id',auth('api')->user()->id)->orderBy('updated_at', 'desc')->get();
//        $count = count($conversations);
//        // $array = [];
//        for ($i = 0; $i < $count; $i++) {
//            for ($j = $i + 1; $j < $count; $j++) {
//                if (isset($conversations[$i]->messages->last()->id) && isset($conversations[$j]->messages->last()->id) && $conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id) {
//                    $temp = $conversations[$i];
//                    $conversations[$i] = $conversations[$j];
//                    $conversations[$j] = $temp;
//                }
//            }
//        }
        Chat::where(['receiver_id'=>auth('api')->user()->id,'read_by_customer'=>0])->update(['read_by_customer'=>1,'read_at'=>Carbon::now()]);

        $messages = Chat::where('sender_id',auth('api')->user()->id)->where('receiver_id','!=',0)->orWhere('receiver_id',auth('api')->user()->id)->orderBy('created_at', 'desc')->get();


        return ChatResource::collection($messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function makeConversationAsRead(Request $request){
        $request->validate([
            'conversation_id'=>'required'
        ]);

        foreach ($conversation->messages as $message){
            $message->update(['read'=>true]);
        }
        return response()->json('success',200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sender_id'=>'required',
            'message'=>'required'
        ]);
        $conversation = Conversation::create([
            'sender_id'=>auth()->user()->id,
            'receiver_id'=>$request['receiver']
        ]);
        Chat::create([
            'message'=>$request['message'],
            'sender_id'=>auth()->user()->id,
            'conversation_id'=>$conversation->id,
            'read'=>false,

        ]);
        return new ConversationResource($conversation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
