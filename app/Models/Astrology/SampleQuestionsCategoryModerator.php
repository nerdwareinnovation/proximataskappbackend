<?php

namespace App\Models\Astrology;

use Illuminate\Database\Eloquent\Model;

class SampleQuestionsCategoryModerator extends Model
{
     public function questions(){
            return $this->hasMany('App\SampleQuestionsModerator','category_id','id');
        }
}
