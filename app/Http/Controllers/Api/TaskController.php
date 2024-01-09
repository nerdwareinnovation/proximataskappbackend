<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
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
    public function show($id)
    {
        $task = Task::find($id);
        return response()->json([
            'data'=> $task,
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
    public function updateTask(Request $request, $id)
    {
        $request->validate([
            'task_type_id' => 'required',
        ]);
        $task = Task::find($id);
        $task->task_type_id = $request->task_type_id;
        $task->save();
        return response()->json([
            'data'=> $task,
            'message'=>"Task status updated successfully",
            'status'=>200,
        ]);
    }
    public function isDeleted($id, Request $request)
    {
        $request->validate([
          'delete_reason'=>'required'
            ]);
        $file = Task::find($id);
        if (!$file) {
            return response()->json(['message' => 'File not found.'], 404);

        }
        $file->update(['is_deleted' => true, 'deleted_at'=>Carbon::now(), 'delete_reason'=>$request->delete_reason]);
        return response()->json(['message' => 'Activity deleted successfully.']);
    }
    public function isRestored($id, Request $request)
    {
        $request->validate([
            'restore_reason'=>'required'
        ]);
        $file = Task::withTrashed()->find($id);
        if (!$file) {
            return response()->json(['message' => 'Activity not found.'], 404);

        }
        if ($file->is_deleted = false){
            return response()->json(['message' => 'Activity cannot be restored.']);
        }
        elseif ($file->is_deleted = true){
            $file->update(['is_deleted' => false,'is_restored'=>true,'restore_reason'=>$request->restore_reason]);
            $file->restore();
        }
        return response()->json(['message' => 'Activity restored successfully.']);
    }

    public function destroy($id){
        $task = Task::onlyTrashed()->find($id);
//        dd($task);
        $task->forceDelete();

        return response()->json([
            'data'=> $task,
            'message'=>"Task deleted successfully",
            'status'=>200,
        ]);
    }

    public function deletedTask()
    {
        $task = Task::onlyTrashed()->first();
        return response()->json([
            'data'=> $task,
            'message'=>"Task deleted successfully",
            'status'=>200,
        ]);

    }
}
