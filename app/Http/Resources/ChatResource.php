<?php

namespace App\Http\Resources;

use App\User;
use App\CustomerRating;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data['id'] = $this->id;
        $data['message'] = $this->message;
        $data['read'] = $this->read;

        $data['sender'] = new UserResource(User::find($this->sender_id));
        $data['receiver'] = new UserResource(User::find($this->receiver_id));
        $data['rating'] = (CustomerRating::where('chat_id',$this->id)->first());
        $data['created_at'] = $this->created_at;
        return $data;
    }
}
