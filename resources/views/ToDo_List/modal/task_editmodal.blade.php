{{-- modal edit task --}}
{{-- id="editForm" action="{{ route('task.upda', $tetask_edit->id) }}" method="post" --}}
<div class="modal fade" id="myModaltask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('task.update')}}" method="post">
      @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModaltask">Edit Tasks</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="text" id="id" name="id">
            <div class="mb-3">
              <label for="" class="form-label">Project Name</label>
             <select name="todo_id" id="todo_id" class="form-control form-select">
              <option value="">select</option>
             
              {{-- <option id="" value="{{$todo_name->id}}" @if($task_shows->todo_id==$todo_name->id) selected @endif>{{$todo_name->name}}</option> --}}
                @foreach (todoname() as $todoedit)
                <option id="" value="{{$todoedit->id}}" >{{$todoedit->name}}</option>
                @endforeach
             
            
             </select>
            </div>
            {{-- @if (auth()->user()->user_type=='admin')
            <div class="mb-3">
              <label for="" class="form-label ">Assigned To</label>
              <select name="user_name[]" id="user_name"  class="form-control bg-light test" multiple="multiple" style="width: 100%;">
                <option value="select">Please Select</option>
               
               
               <option id="" value="" ></option>
              
              </select>
            </div>  
          @endif --}}
            
  
            <div class="mb-3">
              <label for="" class="form-label ">Task Name</label>
              <input type="text" name="task_nameedit" class="form-control" id="task_nameedit">
            </div>
            {{-- <div class="mb-3">
             <label for="" class="form-label ">Status</label>
             <select name="status" id="status" class="form-control form-select">
               <option value="select">Select</option>
               <option value="completed" @if($task_shows->status=="completed") selected @endif>Completed</option>
               <option value="progress" @if($task_shows->status=="progress") selected @endif>In Progress</option>
               <option value="Not_Started" @if($task_shows->status=="Not_Started") selected @endif>Not Started</option>
             </select>
           </div> --}}
           @if (auth()->user()->user_type=='admin')
            <div class="mb-3">
              <label for="" class="form-label ">Prioriti</label>
              <select name="prioriti" id="prioritiedit" class="form-control form-select">
               <option value="select" >Select</option>
               <option value="high"  >High</option>
               <option value="medium" >Medium</option>
               <option value="low" >Low</option>
             </select>
            </div>
         @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="task_updates()">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </form>
  </div>