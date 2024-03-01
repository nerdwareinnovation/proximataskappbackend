<?php

namespace App\Models\Astrology;

use Illuminate\Database\Eloquent\Model;

class CustomerDetails extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function package()
    {
        return $this->belongsTo('App\CustomerPackage','customer_id','user_id');
    }
}
