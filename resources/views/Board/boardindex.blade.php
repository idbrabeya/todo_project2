@extends('layouts.app')
@section('breadcrumb')
@php 
use Carbon\Carbon;
@endphp
<div class="page-title-box">
    <h4 class="page-title">Board </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('employee')}}">Board</a></li>
    </ol>
  </div>
@endsection
@section('content')
    <div class="row">
      <div class="col-md-12">
        <h4 style="bg-secondary">SCRUM BOARD</h4>
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header text-center">
               TODO - (Total: {{$total_project}})
              </div>
              <div class="card-body  viewall_text">
                @php $colors=['alert alert-primary','alert alert-secondary','alert alert-success','alert alert-warning','alert alert-info']; $i=0; @endphp
                @foreach ( $todo_stores as  $todo_store)
                <p id="text" class="p-2 {{$colors[$i]}} ">Project Name: {{$todo_store->todorelation->name??''}} <br>Task Name: {{$todo_store->task_name??''}}. <br> Assignee To:{{$todo_store->user->name??''}}.<br>Start Date: {{\Carbon\Carbon::parse($todo_store->start_date)->format('d/m/y') }}
                </p>
                @php $i++; @endphp
                @if($i==5) @php $i=0; @endphp @endif
                @endforeach
               <button id="viewall" class="btn btn-info btn-sm @if($task_count<=5) d-none @endif ">View All</button>
              
              </div>
            </div>
          </div>
          <div class="col-md-4">
           
            <div class="card">
              <div class="card-header text-center">
              WIP - (Total: {{$task_count}})
              </div>
             
              <div class="card-body  viewall_text">
                @php $colors=['alert alert-secondary','alert alert-primary','alert alert-success','alert alert-warning','alert alert-info']; $i=0; @endphp
                @foreach ( $todo_stores as  $todo_store)
                <?php 
                $start_date = Carbon::parse($todo_store->start_date);
                $end_date = Carbon::parse($todo_store->end_date);
                $dayGet=$start_date->diffInHours($end_date);
              ?>

                <p id="text" class="p-2 {{$colors[$i]}} ">Task Name: {{$todo_store->task_name??''}}. <br> Assignee To:{{$todo_store->user->name??''}}. <br> Status:{{$todo_store->status}}.<br>Hours:{{$dayGet}}
                </p>
                </p>
               
                @php $i++; @endphp
                @if($i==5) @php $i=0; @endphp @endif
                @endforeach
              
              </div>
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header text-center">
               DONE
              </div>
              <div class="card-body ">
                @foreach ( $todo_stores as  $todo_store)
                <p id="todocontent" class="p-2 bg-info">Task: {{$todo_store->task_name}}. <br> Assignee To:erw.<br>Start Date: </p>
                @endforeach
                
                <p class="p-2 bg-danger">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt totam iste cupiditate!</p>
                <p class="p-2 bg-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt totam iste cupiditate!</p>
                <p class="p-2 bg-primary">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt totam iste cupiditate!</p>

                <p class="p-2 bg-light">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt totam iste cupiditate!</p>
                <p class="p-2 bg-warning">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt totam iste cupiditate!</p>

             </div>
            </div>
          </div>
        </div>
      
      </div>
        
    
    </div>
@endsection
@section('scripts')
  <script>
     var offset = 5;
    // var limit =2;
    // var allDataLoaded = false;
  $('#viewall').click(function () { 
    // if(!allDataLoaded){
    $.ajax({
      headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type: 'get',
      url: '{{ route('view.all') }}',
      data: {
        offset: offset
      },
      success: function (response) {
        console.log(response);
        if(response.moredata){
          // allDataLoaded=true;
       $("#viewall").hide();
      }
       if (response.data){
          // console.log(item);
          $('.viewall_text').append(response.data.html);  
       } 
      },
      error: function(error) {
            console.log(error);
        }
    });
    // offset += limit;
  // }
  });
  </script>
@endsection