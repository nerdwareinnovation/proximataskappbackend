<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class PinnedMessage extends Model
{
    protected $fillable = ['message','message_type','sender_id','pinned_by'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
