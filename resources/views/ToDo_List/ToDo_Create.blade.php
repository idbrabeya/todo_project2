<?php
use App\Models\Todo;
?>
@extends('layouts.app')
@section('breadcrumb')
<div class="page-title-box">
  <h4 class="page-title">Projet </h4>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{route('todo.list')}}">Project</a></li>
  </ol>
</div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-info justify-content-between d-flex">
                        <h4>TODO CREATE</h4>
                    </div>
    
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                      </div>
                        @endif
                       
                      <form method="post" action="{{route('todolist.insert')}}" id="todo_create">
                        @csrf
                        <div class="mb-3">
                          <label for="" class="form-label">Title</label>
                          <input type="text" class="form-control" name="name" id="todo_name">
                        </div>
    
                        @if($errors->has('name'))
                       <span class="text-danger">
                         {{$errors->first('name')}}
                       </span>
                        @endif
    
                        <div class="mb-3">
                          <label for="" class="form-label">Description</label>
                          <textarea name="description" id="todo_des" cols="40" class="form-control"></textarea>
                        </div>
                          <button type="submit" class="btn btn-primary" id="add_todo">Add_ToDo</button>
                      </form>
                      
    
                    </div>
                </div>
            </div>

            {{-- todo list show --}}
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-info justify-content-between d-flex">
                        <h4>TODO LIST</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th >ID</th>
                              <th >Title</th>
                              <th >Description</th>
                              <th >Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($todo_show as $key=>$todo)
                            <tr>
                              
                              <input type="hidden" id="" value="{{$todo->id}}" class="todobutton_delete">
      
                              <td>{{ ($key+1) + ($todo_show->currentPage() - 1)*$todo_show->perPage() }}</td>
                              <td>{{$todo->name}}</td>
                              <td>{{$todo->description}}</td>
                              <td>
                                <a type="button" onclick="edit_todo('{{ $todo->id }}','{{ $todo->name}}','{{ $todo->description}}')" class="btn btn-primary btn-sm">Edit</a>
      
                                {{-- <a href="{{route('todo_delete', $todo->id) }}"  class="btn btn-danger btn-sm">Delete</a> --}}
                                <button type="submit"class="btn btn-danger btn-sm todo_delete">Delete</button>
      
                              </td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="5">
                                <div class="div">
                                  <span class="text-danger text-center">ToDo List Emty</span>
                                </div>
                              </td>
                            </tr>
                              
                            @endforelse
                          </tbody>
                      </table>
                      {{$todo_show->links()}}
                    </div>
                </div>
            </div>
    </div>

    @include('ToDo_List.modal.todo_editmodal')
@endsection
@section('scripts')
    {{-- todo add using ajax --}}
<script>
    $(document).ready(function () {
      $('#add_todo').click(function(){
        var todoName = $('#todo_name').val();
        var todoDes = $('#todo_des').val();
        $.ajax({
          headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
  
          type: 'post',
          url: '{{route("todolist.insert")}}',
          data: {
           
            todoName: todoName,
            todoDes: todoDes,
          },
         
          success: function (response) {
            if (response==1) { 
              Swal.fire('New Project Successfully Addedd');
            }
          }
        });
      })
    });
  </script>
  {{-- todo edit using modal --}}
<script>
  
    function edit_todo(id,name,description){
        
      var id= id;
      $.ajax({
        headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
        type: 'get',
        url: '/todo/edit/'+ id,
        success: function (response) {
          // console.log(response);
          $('#ids').val(response.id),
        $('#name').val(response.name),
        $('#description').val(response.description),
     $('#todomodal').modal('show');
     $('#todomodal').modal({
        keyboard: false,
        backdrop: 'static',
    });
  
        },error:function(error){
          console.log(error);
        }
      });  
    }
     
    function todo_update(){
       
      var id =$('#ids').val();
      var name =$('#name').val();
      var description =$('#description').val();
      
      $.ajax({
        headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
        type: 'post',
        url: '/todo/update',
        data: {
          id:id,
          name:name,
        description:description
        },
        success: function (response) {
          if(response.status){
            console.log(response.status);
            location.reload();
            $('#todomodal').modal('hide');
          }
          } ,
        error:function(error){
          if(error.responseJSON && error.responseJSON.errors){
            var errors = error.responseJSON.errors;
            if(errors.name){
              $('#name').addClass('is_invalid');
              $('#name_error').text(errors.name);
            }
          }
          console.log(error);
        }
      });
    }
  
  </script>
  {{-- todo delete sweetalert --}}
<script>
  $(document).ready(function () {
     $('.todo_delete').click(function (el) {
         el.preventDefault();  
         var todoDeleteId = $(this).closest("tr").find('.todobutton_delete').val();   
         Swal.fire({
          title: 'Are you sure to delete this item?',
              width: 400,
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
                     url: '/todo/delete/' + todoDeleteId,
                    
                     success: function (response) {
                        // Swal.fire(response.status==200)
                        if(response.status==200){
                          Swal.fire('Deleted!', 'The todo has been deleted.', 'success').then (function(){
                            location.reload();
                          });
                          
                        }else if(response.status==403){
                          Swal.fire('Error!', 'Oops! This item cannot be deleted because it has associated tasks.', 'error');
  
                        }
                       
                     },
                    
                 });
             }
         });
     });
  });
  </script>
  {{-- todo delete sweetalert end --}}

 
@endsection