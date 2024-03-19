<?php

namespace App\Http\Controllers;
use App\Models\TaskManager;
use App\Models\Projectcreation;
use Illuminate\Http\Request;

class TaskManagerController extends Controller
{
  
    public function addtask(Request $request){
        $lastid = TaskManager::orderBy('priority', 'desc')->pluck('priority')->first();
        $task=new TaskManager();
        $task->name=$request->taskname; 
        $task->priority=$lastid+1; 
        $task->project_id=$request->project_id; 
        $task->save();
        return response()->json(['success' => true,'notice'=>'Task added successfully.']);
    }
    public function gettasks(Request $request){
        $alltasks=TaskManager::where('project_id',$request->project_id)
                ->orderBy('priority', 'asc')->get();
        return response()->json(['alltask' => $alltasks]);
    }
    public function updateTask(Request $request){
        $task_id =TaskManager::find($request->id);
        $task_id->name=$request->taskname;
        $task_id->save();
        return response()->json(['success' => true,'notice'=>'Task updated successfully.']);
    }
    public function deleteTask(Request $request){
        $task_id= TaskManager::find($request->id);
        $task_id->delete();
        return response()->json(['success' => true,'notice' => 'Task Deleted Successfully.']);
    }
    public function updatedraggable(Request $request){
        $data = $request->all();
        foreach($data['newOrder'] as $key=>$row)
        {
            $contentData = TaskManager::where('id',$row['id'])->update(['priority'=>$key+1]);
        }
        return response()->json(['success' => true,'notice' => 'Task updated Successfully.']);

    }
    public function createproject(Request $request){
        $project=new Projectcreation();
        $project->project_name=$request->project_name; 
        $project->save();
        return response()->json(['success' => true,'notice' => 'Project Created Successfully.']);

    }
    public function getprojects(Request $request){
        $allproject=Projectcreation::all();
        return response()->json(['allproject' => $allproject]);

    }
    
}

