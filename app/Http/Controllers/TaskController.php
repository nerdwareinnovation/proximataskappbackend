<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function index(Request $request)
    {
        $task = Task::all();
        $completedCount = Task::where('is_completed', true)->count();
        $incompleteCount = Task::where('is_completed', false)->count();
        $totalTasks = $completedCount + $incompleteCount;
        $percentage = round(($completedCount / $totalTasks) * 100);
        $todo = Task::where('task_type_id',1)->count();
        $delete =Task::onlyTrashed()->count();
        $schedule = Task::where('task_type_id',2)->count();
        $delegate = Task::where('task_type_id',3)->count();
        return view('backend.task')->with(compact('task', 'percentage','todo','delete','schedule','delegate','incompleteCount'));
    }


}
