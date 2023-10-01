<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'total_admin'=>User::where('user_type','admin')->count(),
            'total_employees'=>User::where('user_type','employee')->count(),
            'total_project'=>Todo::count(),
        ]);
    }
    public function employee()
    {
        // $employee_lists = User::all();
        $employee_lists =User::where('user_type','employee')->get();
        return view('Employee.employee',compact('employee_lists'));
    }
    public function add_employee(Request $request){
     $request->validate([
            'em_name'=>'required',
            'em_email'=>'required',
            'em_password' => 'required|min:8',
   ]);

        $employee_add =new User;
        $employee_add->name= $request->em_name;
        $employee_add->email= $request->em_email;
        $employee_add->password= $request->em_password;
        $employee_add->designation= $request->em_designation;
        $employee_add->phone= $request->em_phone;
        $employee_add->status= $request->em_status;
        $employee_add->save();
       return response()->json(['success'=>'200']);    
}

public function user_delete($id){
    $employee_delete=User:: findOrFail($id);
    $employee_delete->delete();
    return response()->json(['status'=>'Employee Deleted!'],200);
}
public function employee_status(Request $request){
    $status_change = User::findOrFail($request->id);
    if($status_change->status==1){
        $status_change->status = 2;
    }else{
        $status_change->status = 1;
    }
    if($status_change->save()){
        return response()->json(['status'=>'Status Changed Successfully!'],200);
    }else{
        return response()->json(['status',403]);
    }
}

    
}
