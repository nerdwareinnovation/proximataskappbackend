<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();
        $completedCount = Task::where('is_completed', true)->count();
        $incompleteCount = Task::where('is_completed', false)->count();
        $totalTasks = $completedCount + $incompleteCount;
        $percentage = round(($completedCount / $totalTasks) * 100);
        $todo = Task::where('task_type_id',1)->count();
        $delete = Task::where('is_deleted',1)->count();
        $schedule = Task::where('task_type_id',2)->count();
        $delegate = Task::where('task_type_id',3)->count();
        
        return view('backend.task')->with(compact('task', 'percentage','todo','delete','schedule','delegate'));
    }


}
