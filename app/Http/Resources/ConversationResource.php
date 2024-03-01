<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * @var mixed
     */
    /**
     * @var mixed
     */



    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data['id'] = $this->id;
        $data['user'] = auth()->user()->id == $this->sender_id ? new UserResource(User::find($this->receiver_id)) :  new UserResource(User::find($this->sender_id)) ;
        $data['created_at'] = $this->created_at;
        $data['messages'] = ChatResource::collection($this->messages);

        return $data;
    }
}
