<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $task = Task::all();
        return response()->json([
            'data'=>$task,
            'status'=> 200
        ]);
    }
    public function store(Request $request){
        $input = $request->all();
        $request->validate([
            'task_type_id' => 'required',
            'task_title' => 'required',
            'task_requirements' => 'required',
            'due_date' => 'required',
            'due_time_start' => 'required',
            'due_time_end' => 'required',

        ]);
        $input['user_id'] = auth()->user()->id;
        $task = Task::create($input);
        return response()->json([
            'data'=> $task,
            'message'=>"Task created successfully",
            'status'=>200,
        ]);
    }

    public function update(Request $request, $id){

        $input = $request->all();
        $request->validate([
            'task_type_id' => 'required',
            'task_title' => 'required',
            'task_requirements' => 'required',
            'due_date' => 'required',
            'due_time_start' => 'required',
            'due_time_end' => 'required',

        ]);
        $task = Task::find($id);
        $task->task_type_id = $request->task_type_id;
        $task->task_title = $request->task_title;
        $task->task_requirements = $request->task_requirements;
        $task->due_date = $request->due_date;
        $task->due_time_start = $request->due_time_start;
        $task->due_time_end = $request->due_time_end;
        $task->budget = $request->budget;
        $task->attachment = $request->attachment;
        $task->voice_note = $request->voice_note;
        $task->delete_reason = $request->delete_reason;
        $task->restore_reason = $request->restore_reason;
        if (isset($request->is_important)){
            $task->is_important=1;
        }else{
            $task->is_important=0;
        }
        if(isset($request->is_urgent)){
        $task->is_urgent=1;
        }
        else
        {
        $task->is_urgent = 0;
        }
        if(isset($request->set_remainder)){
            $task->set_remainder = 1;
        }
        else{
            $task->set_remainder =0;
        }
        if (isset($request->is_restored)){
            $task->is_restored=1;
        }else{
            $task->is_restored=0;
        }
        $task->save();
        return response()->json([
            'data'=> $task,
            'message'=>"Task updated successfully",
            'status'=>200,
        ]);
    }

    public function destroy($id){
        $task = Task::find($id);
        $task->delete();

        return response()->json([
            'data'=> $task,
            'message'=>"Task deleted successfully",
            'status'=>200,
        ]);
    }
}
