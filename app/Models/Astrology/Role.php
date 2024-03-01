<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
