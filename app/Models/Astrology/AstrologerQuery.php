<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class AstrologerQuery extends Model
{
    protected $fillable = [];
    public function chat(){
        return $this->hasOne('App\Chat','id','chat_id');
    }
    public function reply(){
        return $this->hasOne('App\Chat','id','reply_id');
    }
    public function astrologer(){
        return $this->hasOne('App\AstrologerDetails','id','astrologer_id');
    }

    public function moderator(){
        return $this->hasOne('App\User','id','moderator_id');
    }

    public function rating(){
        return $this->hasOne('App\AstrologerRating','query_id','id');
    }
    public function customer_rating(){
        return $this->hasOne('App\CustomerRating','chat_id','reply_id');
    }
     public function revertedQuery(){
            return $this->hasMany('App\BackToMod','query_id','id');
        }
}
