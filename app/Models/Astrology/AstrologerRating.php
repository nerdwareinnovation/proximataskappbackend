<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class AstrologerRating extends Model
{
    public function astroQuery(){
        $this->belongsTo('App\AstrologerQuery');
    }

    public function astrologer(){
        $this->belongsTo('App\AstrologerDetails');
    }

}
