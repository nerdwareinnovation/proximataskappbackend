<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();
        return view('backend.task')->with(compact('task'));
    }
}
