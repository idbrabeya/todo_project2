<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Task;

class BoardController extends Controller
{
    public function board_index(Request $request){
        
        // $dayGet =$start_date->diffInDays($end_date);
        // $end_date = Carbon::parse($request->start_date);
        // $date =$start_date->diffInDays ($end_date); 
      
        return view('Board.boardindex',[
            'total_project'=>Todo::count(),
            'todo_stores'=>Task::orderBy('id','asc')->take(5)->get(),
            'task_count'=>Task::count(),
        ]);
    }
    public function view_all(Request $request){
        $offset = $request->offset;
        $limit =100000;
       $offsetstores= Task::skip( $offset)->take($limit)->get();
       $moredata =Task::count()<=$offset + $limit;
       $html ='';
       $colors=['alert alert-primary','alert alert-secondary','alert alert-success','alert alert-warning','alert alert-info'];
       $i=0;
       foreach($offsetstores as $todo_store) {
        $html .= '<p class="p-2 ' . $colors[$i] . '">Task Name: ' . $todo_store->task_name . '. <br> Assignee To:' . $todo_store->user->name . '.<br>Start Date: ' . \Carbon\Carbon::parse($todo_store->start_date)->format('d/m/y') . '</p>';
        if($i==5){$i=0;}
        $i++;
        }
       $res=[
        'data'=>['html'=> $html,
       ],
       'moredata'=>$moredata
    ];
       return response()->json($res);   
    }
    
}
