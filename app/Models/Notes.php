<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    protected $fillable=['font', 'note', 'color_option','note_title','theme','user_id','is_completed'];
}
