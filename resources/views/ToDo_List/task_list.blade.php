@extends('layouts.app')
@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Task List</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('todo.list')}}">Task List</a></li>
    </ol>
  </div>
@endsection
@section('content')
    <div class="">
      <div class="row">
        <div class="col-md-12 justify-content-end d-flex">
            <a href="" type="submit" class="btn btn-info" data-toggle="modal" data-target="#taskmodal" >Task Add</a>

        </div>
    </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info justify-content-between d-flex">
                        <h4>TASK LIST</h4>
                    </div>
        
                    <div class="card-body">
                        <table class="table table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th >ID</th>
                              {{-- <th >Task Creator</th> --}}
                              <th >Project Name</th>
                              <th >Task Name</th>
                              @if (auth()->user()->user_type=='admin')
                              <th >Assigned To</th>
                               @endif
                              <th >Status</th>
                              <th >Prioriti</th>
                    
                              <th >Task Complet</th>
                              <th >Start Date</th>
                              <th >End Date</th>
                              <th >Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($task_show as $key=>$task_shows)
                            <tr>
                              {{-- <input type="hidden" class="button_delete" value="{{$task_shows->id}}"> --}}
                              <td>{{($key+1) + ($task_show->currentPage() - 1) * $task_show->perPage()}}</td>
                              {{-- <td>{{$task_shows->user->user_id}}</td> --}}
                              <td>{{optional(optional($task_shows->task)->todo)->name}}</td>
                              <td>{{optional($task_shows->task)->task_name}}</td>
                              @if (auth()->user()->user_type=='admin')
                              <td>
                                {{optional($task_shows->user)->name??''}}
                              </td>
                                 @endif
                              <td>
                              
                               <select name="task_status" class="task_status form-select" value="" id="task_id" onchange="statusChange(this,{{optional($task_shows->task)->id}})">
                                <option value="">Select Please</option>
                                 <option @if(optional($task_shows->task)->status == 'completed') selected @endif value="completed">Completed</option>
                                  <option  @if(optional($task_shows->task)->status == 'progress') selected @endif value="progress">In Progress</option>
                                  <option  @if(optional($task_shows->task)->status == 'Not_Started') selected @endif value="Not_Started">Not Started</option>
                              </select>
                              
                        
                                {{-- {{$task_shows->status}} --}}
                              </td>
                              <td>{{optional($task_shows->task)->prioriti}}</td>
                                 {{-- @if (auth()->user()->is_admin==1)
                                   <td>{{$task_shows->user_name}}</td>
                                   
                                 @endif --}}
                             
        
                              <td>{{optional($task_shows->task)->current_dates}}</td>
                              <td>{{optional($task_shows->task)->start_date}}</td>
                              <td>{{optional($task_shows->task)->end_date}}</td>
                             
                              <td>
                                {{-- <button class="btn btn-info btn-sm button_edit" value="{{$task_shows->id}}" type="button" data-bs-target="#myModaltask" data-bs-toggle="modal">Edit</button> --}}
                                 
                                <a class="btn btn-primary btn-sm" onclick="Task_edit('{{optional($task_shows->task)->id}}','{{$task_shows->todo_id}}','{{$task_shows->prioriti}}','{{$task_shows->task_name}}','{{$task_shows->user_name}}')" type="button" id="" name=""><i class="fa-solid fa-pen-to-square"></i></a>
                        
                                <button type="button" class="btn btn-danger btn-sm show_confirm" data-ass-id="{{ $task_shows->id }}"><i class="fa-solid fa-trash-can"></i></button>

                                {{-- <a href="{{route('task_view',$task_shows->id)}}" class="btn btn-warning btn-sm">View</a> --}}
                              </td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="5">
                                <div class="div">
                                  <span class="text-danger text-center">Task List Emty</span>
                                </div>
                              </td>
                            </tr>
                            @endforelse
                          </tbody>
                      </table>
                      {{$task_show->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('ToDo_List.modal.taskaddmodal')
    @include('ToDo_List.modal.task_editmodal')
@endsection

@section('scripts')
{{-- task add --}}
<script>
  $(document).ready(function () {
      $('#taskSave').click(function () {
          var todo_select_id = $('#todo_select_id').val();
          // var selectElement = document.getElementById('assigned_select_id');
          // var assigned_select_id = [];
          // for (var i = 0; i < selectElement.options.length; i++) {
          //   var option = selectElement.options[i];
          //   if (option.selected) {
          //     assigned_select_id.push(option.value);
          //   }
          // }
          // console.log(assigned_select_id);
          var task_name = $('#task_name').val();
          var task_des = $('#task_des').val();
          var assigned_select_id = $('#assigned_select_id').val();
          var task_status = $('#task_status').val();
          var prioriti = $('#prioriti').val();
          var start_date = $('#start_date').val();
          var end_date = $('#end_date').val();
         $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'post',
          url: "{{route('task.list.insert')}}",
          data: {
            todo_select_id: todo_select_id,
            task_name: task_name,
            task_des: task_des,
            assigned_select_id: assigned_select_id,
            task_status: task_status,
            prioriti: prioriti,
            start_date: start_date,
            end_date: end_date
          },
          success: function (response) {
            if (response) {
              console.log(response);
              $('#taskmodal').modal({
                keyboard: false,
                backdrop: 'static'
              }).modal('hide');
                
            } 
          },
          error: function (error) {
            if(error.responseJSON && error.responseJSON.errors){
           var errors ="";   
           errors = error.responseJSON.errors;

            if(errors.task_name){
              $('#task_name').addClass('is_invalid');
              $('#vali_taskname').text(errors.task_name[0]);
            }else{
              $('#task_name').removeClass('is_invalid');
              $('#vali_taskname').text('');
            }

            if(errors.todo_select_id){
              $('#todo_select_id').addClass('is_invalid');
              $('#vall_todo_id').text(errors.todo_select_id[0]);
            }else{
              $('#todo_select_id').removeClass('is_invalid');
              $('#vall_todo_id').text('');
            }

            if(errors.prioriti){
              $('#prioriti').addClass('is_invalid');
              $('#vali_prioriti').text(errors.prioriti[0]);
            }else{
              $('#prioriti').removeClass('is_invalid');
              $('#vali_prioriti').text('');
            }
            console.log(error);
          }
          }
         }); 
      });
  });
</script>
    {{-- todo select2 --}}
    <script>
    $(document).ready(function() {
    $('#taskmodal').on('shown.bs.modal', function () {
      $('#todo_select_id').select2();
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
   {{-- status change start --}}
<script>
  function statusChange(el, id) {
    var newStatus = el.value;
    Swal.fire({
        title: 'Are you sure to change status?',
        icon: 'warning',
        width: 300,
        height: 300,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
              headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: '{{route("status.change")}}',
                type: 'get',
                data: { task_id: id, newStatus: newStatus},
                success: function (response) {
                    Swal.fire({title: response.status,
                               icon: "success", width: 300,}).then(function () {
                        // table.ajax.reload(null, false);
                        location.reload();
                    });
                },
                error: function () {
                    Swal.fire('Oops...', "Something went wrong with AJAX!", "error");
                }
            });
        }
    })
}
</script>
{{-- task edit data --}}
<script>
  function Task_edit(id,todo_id,prioritiedit,task_nameedit,user_name) {
      var id = id;
      $.ajax({
              headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        
        url: '/task/edit/'+id,
        type: 'get',
        success: function (response) {
          console.log(response);
          $('#id').val(response.id);
          $('#todo_id').val(response.todo_id);
          $('#task_nameedit').val(response.task_name);
          $('#prioritiedit').val(response.prioriti);
          var selectedValues = response.user_name;
          if(selectedValues !==''&& selectedValues){
          var temp = new Array();
          temp = selectedValues.split(",");
        
          $('#user_name').val(temp).trigger('change');
        }

          $('#myModaltask').modal('show');
        },
        error: function (error) {
          console.log(error);
            Swal.fire('Oops...', "Something went wrong with AJAX!", "error");
        }
    });  
  }

  function task_updates(){
    var id = $('#id').val();
    var todo_id = $('#todo_id').val();
    var task_nameedit = $('#task_nameedit').val();
    var prioriti = $('#prioritiedit').val();
    var user_name = $('#user_name').val();
    

          $.ajax({
            headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
            type: 'post',
            url: '/task/update',
            data: {
              id: id ,
              todo_id: todo_id,
              task_nameedit: task_nameedit,
              prioriti :  prioriti,
              user_name:user_name,

            },
           
            success: function (response) {
              if(response.success)
              location.reload();
              $('#myModaltask').modal('hide');
            }, error:function (error){
              console.log(error);
            }
          });
  }
</script>

{{-- task delete sweetalert --}}
<script>
  $(document).ready(function () {
     $('.show_confirm').click(function(el){
         el.preventDefault();
        //  var buttonId = $(this).closest("tr").find('.button_delete').val();
        var buttonId = $(this).data('ass-id');
         Swal.fire({
             title: 'Are you sure to delete this task?',
             width: 400,
             height: 50,
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
             if (result.isConfirmed) {
                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     type: 'get',
                     url: '/task/delete/' + buttonId,
                     success: function (response) {
                         Swal.fire({
                             title: response.status,
                             icon: "success",
                         }).then((result) => {
                             location.reload();
                           
                         });
                     },
                     error: function (xhr, status, error) {
                         Swal.fire({
                             title: 'Error',
                             text: 'An error occurred while deleting the item.',
                             icon: 'error',
                         });
                     }
                 });
             }
         });
     });
 });
 </script>
@endsection