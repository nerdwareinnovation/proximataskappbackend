<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
class TaskController extends Controller
{
    public function index(Request $request)
    {

        $user_id = auth()->user()->id;
//        dd($user_id);
        $task = Task::where('user_id',$user_id)->get();
//        dd($task);
        $completedCount = Task::where('is_completed', true)->where('user_id',$user_id)->count();
        $incompleteCount = Task::where('is_completed', false)->where('user_id',$user_id)->count();
        $totalTasks = $completedCount + $incompleteCount;
        $percentage = round(($completedCount / $totalTasks) * 100);
        $todo = Task::where('task_type_id',1)->where('user_id',$user_id)->count();
        $delete =Task::onlyTrashed()->where('user_id',$user_id)->count();
        $schedule = Task::where('task_type_id',2)->where('user_id',$user_id)->count();
        $delegate = Task::where('task_type_id',3)->where('user_id',$user_id)->count();
        return view('backend.task')->with(compact('task', 'percentage','todo','delete','schedule','delegate','incompleteCount','totalTasks','completedCount'));
    }


}
