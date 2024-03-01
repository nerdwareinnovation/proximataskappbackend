<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class BackToMod extends Model
{
     public function astro_query(){
        return $this->hasOne('App\AstrologerQuery', 'id','query_id');
    }
}
