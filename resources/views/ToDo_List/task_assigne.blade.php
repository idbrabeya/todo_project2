<?php
use App\Models\Task;
?>
@extends('layouts.app')
@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Task Assignees </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('assignee')}}">Task Assignee</a></li>
    </ol>
  </div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-info justify-content-between d-flex">
                    <h4>TASK ASSIGNEE</h4>
                </div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                  </div>
                    @endif
                   
                  <form method="post" action="{{route('todolist.insert')}}" enctype="multipart/form-data" id="todo_create">
                    @csrf
                    <div class="mb-3">
                      <label for="" class="form-label">Task Name</label>
                      <select name="task_name" id="task_name" class="form-control form-select">
                        <option value="select" >Please Select</option>
                        @foreach (tasks() as $task_name)
                        <option value="{{$task_name->id}}">{{$task_name->task_name}}</option>
                        @endforeach
                       
                      </select>
                    </div>

                    @if($errors->has('name'))
                   <span class="text-danger">
                     {{$errors->first('name')}}
                   </span>
                    @endif

                    <div class="mb-3">
                      <label for="" class="form-label">Assigned To</label>
                      <select name="task_name" id="task_name" class="form-control form-select">
                        <option value="select" >Please Select</option>
                        @foreach (users() as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                       
                      </select>
                    </div>
                      <button type="submit" class="btn btn-primary" id="add_todo">Submit</button>
                  </form>
                  

                </div>
            </div>
        </div>

        {{-- todo list show --}}
        {{-- <div class="col-md-7">
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
                
                </div>
            </div>
        </div> --}}
</div>
@endsection