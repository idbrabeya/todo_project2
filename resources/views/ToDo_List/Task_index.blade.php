@extends('layouts.app')
@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Task </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('todo.list')}}">Task</a></li>
    </ol>
  </div>
@endsection
@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header bg-info justify-content-between d-flex">
                        <h4>TASK CREATE</h4>
                    
                    </div>
                    <div class="card-body">
                   {{-- todo name show code end --}}
                      <form action="{{route('task.list.insert')}}" method="post">
                          @csrf
                           <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label for="" class="form-label">Project Name</label>
                                 <select name="todo_id" id="todo_select_id" class="form-control form-select">
                                  <option value="" selected>select</option>
                                 
                                 @foreach (todoname() as $todoname)
                                  <option value="{{$todoname->id}}">{{$todoname->name}}</option>
                                   @endforeach
                                 
                                 </select>
                                </div>
                              </div>
                            <div class="col-md-6">
                               
                                    <label for="" class="form-label ">Task Name</label>
                                    <input type="text" name="task_name" class="form-control" id="">
                                  
                                  @if($errors->has('task_name'))
                                  <span class="text-danger">
                                    {{$errors->first('task_name')}}
                                  </span>
                                   @endif
                            </div>
                           </div>
                           <div class="row">
                            @if (auth()->user()->user_type!='admin')
                            <div class="col-md-12">
                              <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea type="text" class="form-control" name="task_des" id="description" value=""></textarea>
                              </div>
                            </div>
                            @else
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea type="text" class="form-control" name="task_des" id="description" value=""></textarea>
                              </div>
                            </div>
                              <div class="col-md-6">
                                <div class="mb-3">
                                  <label for="" class="form-label ">Assigned To</label>
                                  <select name="assigne_employee" id="assigned_select_id" class="form-control form-select assigned_select">
                                    <option value="">Please Select</option>
                                   @foreach (App\Models\Employee:: all() as $employeeName)
                                   <option value="{{$employeeName->id}}">{{$employeeName->name}}</option>
                                   @endforeach
                                  </select>
                                </div>
                              </div>
                            @endif

                          </div>
                        
                          
                           <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label for="" class="form-label ">Status</label>
                                <select name="status" id="status2" class="form-control form-select">
                                  <option value="">Select</option>
                                  <option value="completed">Completed</option>
                                  <option value="progress">In Progress</option>
                                  <option value="Not_Started">Not Started</option>
                                 
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
      
                              <div class="mb-3">
                                <label for="" class="form-label ">Prioriti</label>
                                <select name="prioriti" id="" class="form-control form-select">
                                 <option value="select">Select</option>
                                 <option value="high">High</option>
                                 <option value="medium">Medium</option>
                                 <option value="low">Low</option>
                               </select>
                              </div>
                            </div>
                           </div>
                        
                            <div class="row">
                              <div class="col-6">
                                <div class="mb-3">
                                  <label for="" class="form-label">Start Date</label>
                                  <input type="date" class="form-control" name="start_date" >
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="mb-3">
                                  <label for="" class="form-label">End Date</label>
                                  <input type="date" class="form-control" name="end_date" >
                                </div>
                              </div>
                            </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                   </div>
                </div>
            </div>
            {{-- table --}}
          </div>
    </div>
@endsection
@section('scripts')
    {{-- todo select2 --}}
<script>
    $(document).ready(function() {
      $('#todo_select_id').select2({
        // sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
      });
    });
  </script>
   {{-- assigne select2 --}}
<script>
  $(document).ready(function() {
    $('#assigned_select_id').select2({
      // sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
    });
  });
</script>
@endsection