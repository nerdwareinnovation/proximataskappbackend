<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class SampleQuestionsCategory extends Model
{
    public function questions(){
        return $this->hasMany('App\SampleQuestions','category_id','id')->orderBy('order_ques');
    }
}
