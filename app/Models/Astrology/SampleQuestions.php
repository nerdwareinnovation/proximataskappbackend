<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class SampleQuestions extends Model
{
    public function category(){
        return $this->belongsTo('App\SampleQuestionsCategory');
    }
}
