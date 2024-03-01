<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class AstrologerDetails extends Model
{
    public function rating(){
        return $this->hasMany('App\AstrologerRating','astrologer_id','id');
    }

    public function queries(){
        return $this->hasMany('App\AstrologerDetails');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
