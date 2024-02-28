<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function dashboard(){
        $user_id = auth()->user()->id;
        $task = Task::where('user_id',$user_id)->get();
        $completedCount = Task::where('is_completed', true)->count();
        $incompleteCount = Task::where('is_completed', false)->count();
        $totalTasks = $completedCount + $incompleteCount;
        $todo = Task::where('task_type_id',1)->where('user_id',$user_id)->count();
        $delete =Task::onlyTrashed()->where('user_id',$user_id)->count();
        $schedule = Task::where('task_type_id',2)->where('user_id',$user_id)->count();
        $delegate = Task::where('task_type_id',3)->where('user_id',$user_id)->count();
        $notes = Notes::all();
        return view(' backend.dashboard',compact('completedCount', 'totalTasks','incompleteCount','delete','todo','schedule','delegate'));
    }

}
