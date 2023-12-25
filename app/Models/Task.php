<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Task extends Model
{
    use HasFactory;
    protected $table = 'task';

    protected $fillable = ['task_title','task_type_id','parent_task_id','task_title' ,'task_requirements', 'due_date', 'due_time_start', 'due_time_end','budget', 'attachment','voice_note','delete_reason','is_deleted','restore_reason','is_restored','is_urgent','is_important','set_remainder','user_id'];
}
