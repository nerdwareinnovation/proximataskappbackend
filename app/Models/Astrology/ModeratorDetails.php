<?php

namespace App\Models\Astrology;


use Illuminate\Database\Eloquent\Model;

class ModeratorDetails extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
