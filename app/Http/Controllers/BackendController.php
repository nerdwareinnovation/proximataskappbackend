<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function dashboard(){

        $completedCount = Task::where('is_completed', true)->count();
        $incompleteCount = Task::where('is_completed', false)->count();
        $totalTasks = $completedCount + $incompleteCount;
        $delete =Task::onlyTrashed()->count();
        return view(' backend.dashboard',compact('completedCount', 'totalTasks','incompleteCount','delete'));
    }

}
