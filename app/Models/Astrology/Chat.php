<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['message','sender_id','conversation_id','read'];
    public function conversation(){
        $this->belongsTo('App\Conversation');
    }
    public function astrologerQuery(){
        return $this->hasOne('App\AstrologerQuery');
    }
    public function sender(){
        return $this->hasOne('App\User', 'id','sender_id');
    }
     public function rating(){
        return $this->hasOne('App\CustomerRating','chat_id','id');
    }

}
