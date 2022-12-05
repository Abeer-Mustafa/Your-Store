<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

use App\Models\Task;

class TaskController extends Controller
{
   public function getTasks(){
        $tasks = Task::all();
        return view('admin.layouts.getTasks', compact('tasks')); 
    }     
    public function getInfoTask(){
        $taskId = $_GET['taskID'];
        $task = Task::whereId($taskId)->first();
        $title = $task->task_title;
        $description = $task->description;
        $duration = $task->duration;
        return response()->json(['task_title'=>$title, 'description'=>$description, 'duration'=>$duration]);
    }   
    public function addTask(Request $request) { 
        $rules = array(
            'task_title'  => 'required|string',
            'description' => 'required|string',
            'duration'    => 'required|numeric',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
            return response()->json(['errors' => $error->errors()->all()]);
        $form_data = array(
            'task_title'  =>  $request->task_title,
            'description' =>  $request->description,
            'duration'    =>  $request->duration,
        );
        $task = Task::create($form_data);
        return response()->json(['success' => __('controller.dashNewTask')]);
    }   

    public function editTask(Request $request) { 
        $rules = array(
            'task_title'  => 'required|string',
            'description' => 'required|string',
            'duration'    => 'required|numeric',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
            return response()->json(['errors' => $error->errors()->all()]);
        $form_data = array(
            'task_title'  =>  $request->task_title,
            'description' =>  $request->description,
            'duration'    =>  $request->duration,
        );
        $taskId = $request->taskId;
        Task::whereId($taskId)->update($form_data);
        return response()->json(['success' => __('controller.dashEditTask')]);
    }    

    public function delTask(Request $request) { 
        $taskId = $_GET['taskID'];
        Task::findOrFail($taskId)->delete();
        return response()->json(['success' => __('controller.dashdeleteTask') ]);
    } 
}
