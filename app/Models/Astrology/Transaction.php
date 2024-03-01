<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function customer(){
        return $this->hasOne('App\User', 'id','customer_id');
    }
    public function package(){
        return $this->hasOne('App\Package', 'id','package_id');
    }
}
