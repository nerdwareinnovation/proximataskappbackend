<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class CustomerPackage extends Model
{
    public function customer(){
        return $this->hasOne('App\CustomerDetails');
    }
    public function package(){
        return $this->hasOne('App\Package','id','package_id');
    }


}
