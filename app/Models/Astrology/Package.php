<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function customerPackage()
    {
        return $this->belongsTo('App\CustomerPackage');
    }
}
