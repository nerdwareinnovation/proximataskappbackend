<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class CustomerRating extends Model
{
    public function chat(){
            $this->belongsTo('App\Chat');
        }

    public function customer(){
        $this->belongsTo('App\Customer');
    }
    public function astroChat(){
        $this->belongsTo('App\AstrologerQuery');
    }
}
