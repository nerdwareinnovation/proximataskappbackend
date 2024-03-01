<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class SampleQuestionsModerator extends Model
{
    public function category(){
            return $this->belongsTo('App\SampleQuestionsCategoryModerator');
        }
}
