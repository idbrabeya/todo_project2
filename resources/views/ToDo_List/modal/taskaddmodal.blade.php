<div class="modal fade" id="taskmodal"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <form action="" method="">
       @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="todomodal">Create Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
           <input type="hidden" id="idtask" name="id">
           <div class="card-body">
            {{-- todo name show code end --}}
                     <div class="col-md-12">
                         <div class="mb-3">
                          
                           <label for="" class="form-label">Project Name <span class="text-danger">*</span></label>
                          <select name="todo_select_id" id="todo_select_id" class="form-control form-select">
                           <option value="" selected>select</option>
                          @foreach (todoname() as $todoname)
                           <option value="{{$todoname->id}}">{{$todoname->name}}</option>
                            @endforeach
                          </select>
                          <span class="text-danger" id="vall_todo_id"></span>
                         </div>
                       </div>
                     <div class="col-md-12">
                        <label for="" class="form-label ">Task Name <span class="text-danger">*</span></label>
                        <input type="text" name="task_name" class="form-control" id="task_name" >
                        <span class="text-danger" id="vali_taskname"></span>
                     </div>
                     
                     
                     <div class="col-md-12">
                       <div class="mb-3">
                         <label for="" class="form-label">Description</label>
                         <textarea type="text" class="form-control" name="task_des" id="task_des" value=""></textarea>
                       </div>
                     </div>
                     @if (auth()->user()->user_type =='admin')
                       <div class="col-md-12">
                         <div class="mb-3">
                           <label for="" class="form-label ">Assigned To</label>
                           <select name="assigne_employee[]" id="assigned_select_id" class="form-control form-select assigned_select" multiple="multiple">
                             <option value="">Please Select</option>
                            @foreach (App\Models\User::where('user_type','employee')->get() as $employeeName)
                            <option value="{{$employeeName->id}}">{{$employeeName->name}}</option>
                            @endforeach
                           </select>
                         </div>
                       </div>
                     @endif
                     <div class="col-md-12">
                       <div class="mb-3">
                         <label for="" class="form-label ">Status</label>
                         <select name="status" id="task_status" class="form-control form-select">
                           <option value="">Select</option>
                           <option value="completed">Completed</option>
                           <option value="progress">In Progress</option>
                           <option value="Not_Started">Not Started</option>
                         </select>
                       </div>
                     </div>
                     <div class="col-md-12">
                       <div class="mb-3">
                         <label for="" class="form-label ">Prioriti <span class="text-danger"> * </span></label>
  
                        <select name="prioriti" id="prioriti" class="form-control form-select" >
                          <option value="">Please Select</option>
                          <option value="high">High</option>
                          <option value="medium">Medium</option>
                          <option value="low">Low</option>
                        </select>
                        <span class="text-danger" id="vali_prioriti"></span>

                       </div>
                     </div>
                     <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="" class="form-label">Start Date</label>
                          <input type="date" class="form-control" name="start_date" id="start_date" value="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="" class="form-label">End Date</label>
                          <input type="date" class="form-control" name="end_date" id="end_date" value="">
                        </div>
                      </div>
                     </div>    
                </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="taskSave">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>
      </div>
    </div>
</form>
</div>