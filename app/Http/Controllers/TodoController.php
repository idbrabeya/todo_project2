<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use App\Models\Task;
use App\Models\Assignmenttask;
use Illuminate\Http\Request;
Use \Carbon\Carbon;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function todo_list_create(){
        //    todo list
        if (auth()->user()->user_type=='admin') {
            $todo_show=Todo::paginate(5);
            
        }  else{
            $todo_show=Todo::where('user_id',Auth()->user()->id)->paginate(5);
        }
            return view('ToDo_List.ToDo_Create',compact('todo_show'));
        }

        public function todolist_insert(Request $request){
            $user_id=auth()->user()->id;
            $request->validate([
                     'name'=>'required|unique:todos',
            ]);
    
           $Todoinsert=new Todo;
           $Todoinsert->user_id= $user_id;
           $Todoinsert->name =$request->name;
           $Todoinsert->description =$request->description;
           $Todoinsert->save();
           return back()->with('success', 'Todo item added successfully!');
        }
        public function todo_edit($id){
            $todo_edit = Todo::findOrFail($id);
             return response()->json( $todo_edit);
            
         }
         public function todo_update(Request $request){
             $request->validate([
                 'name' => 'required|unique:todos,name,' . $request->id,
                
             ]);
     
         $todo_update=Todo::findOrFail($request->id);
         $todo_update->name=$request->name;
         $todo_update->description =$request->description ;
         $todo_update->save();
         // return back();
         return response()->json(['status' => 'ToDoList item updated successfully']);
     
         }
         public function todo_delete($id){
            $task_id=Task::where('todo_id',$id)->first();
              if($task_id==null){
                  Todo::findOrFail($id)->delete();
                  return response()->json(['status' => 200, 'message' => 'Deleted successfully!']);
      
              }else{
                  return response()->json(['status' => 403, 'message' => 'Oops! This item cannot be deleted because it has associated tasks.']);
              }
          //    return back();
             
             
          }
        public function task_index(){
            // $taskk=Task::all();
            // return $taskk;
            return view('ToDo_List.Task_index');
        }
     
         public function task_list_insert(Request $request){
            $request->validate([
                'task_name'=>'required',
                'todo_select_id'=>'required',
                'prioriti'=>'required',
            ]);

            try{ 
             $user_id=auth()->user()->id; 
             $user_names_check= $request->input('assigned_select_id',[]);
             $user_names = implode(',',$user_names_check);
             
             $task_insert = new Task;
             $task_insert->todo_id  = $request->todo_select_id;
             $task_insert->created_by = $user_id;
     
        //    if(isset($task_insert->user_name)){
        //      $task_insert->user_name  = $user_names;
        //    }
            //  $task_insert->assigne_to = $request->assigned_select_id;
             $task_insert->assigne_to = $user_names;
             $task_insert->task_name  = $request->task_name;
             $task_insert->task_des  = $request->task_des;
             $task_insert->status  = $request->task_status;
             $task_insert->prioriti = $request->prioriti;
             $task_insert->current_dates= $request->current_dates;
             $task_insert->start_date = $request->start_date;
             $task_insert->end_date = $request->end_date;
             $task_insert->save();

             
           
            //  $assinee = $request->assigned_select_id ;
            //  if(!is_array( $user_names)){
            //     $user_names=[$user_names];
            //  }
            $task_id = $task_insert->id;
            $task_status = $task_insert->status;
             $assigneds = $request->assigned_select_id;
            
             foreach ($assigneds as $user_id) {
                Assignmenttask::create([
                       'user_id' => (int)$user_id,
                       'task_id' => $task_id,
                       'status'=> $task_status,
                ]);
            }

             return response()->json(['status'=>'200']);
            }catch(\Exception $e){
                return response()->json(['status'=>'403','message'=>$e->getMessage()]);
            }
            
     
         }
         public function task_list(){
            // task list
        if (auth()->user()->user_type=='admin') {
            $task_show=Assignmenttask::with('user', 'task', 'task.todo')->paginate(5); 

        }  else{
            $task_show=Assignmenttask::with('user', 'task', 'task.todo')->where('user_id', auth()->user()->id)->paginate(5);
        
        }
        // return $task_show;
        return view('ToDo_List.task_list',compact('task_show'));
         }

         public function task_edit($id){
            $task_edit = task::findOrFail($id);
            return response()->json($task_edit);
            
        }
        
        public function task_update(Request $request){
           
            // $user_names_check= $request->input('user_name',[]);
            // $user_names = implode(',',$user_names_check);
    
            // dd($request->all());
            $task_update = Task::findOrFail($request->id);
            $task_update->todo_id = $request->todo_id;
            $task_update->task_name = $request->task_nameedit;
            
        //    if(isset($task_update->user_name)){
        //     $task_update->user_name = $user_names;
    
        //    }
    
            $task_update->prioriti = $request->prioriti;
            $task_update->update();
            // return back();
            return response()->json(['success'=>true]);
        }

         public function task_delete($id){
             $task_delete=Assignmenttask::findOrFail($id);
            // $task_delete=Task::where('todo_id',$todo_id)->delete();
             $task_delete->delete();
            return response()->json(['status'=>'Task deleted successfully!']);

        }

         public function status_change(Request $request){
            //  $request->all();
           $taskId = $request->task_id;
           $status = $request->newStatus;
           $updateStatus = Task::findOrFail($taskId);
           if($updateStatus){
             $updateStatus->status= $status;
             if($status=='completed'){
                $updateStatus->current_dates=Carbon::now()->format('d-m-Y');
             }else{
    
                $updateStatus->current_dates=null;
               
             }
             $updateStatus->save();
             return response()->json(['status' => 'status changed successfully!'],200);
           }
        
    }
    public function assignee(){
        return view('ToDo_List.task_assigne');
    }
       
        
}
