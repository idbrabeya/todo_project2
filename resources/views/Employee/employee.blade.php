@extends('layouts.app')
@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Employee </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('employee')}}">Employee</a></li>
    </ol>
  </div>
@endsection
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-12 justify-content-end d-flex">
                <a href="" type="submit" class="btn btn-info" data-toggle="modal" data-target="#employeemodal" >Employee Add</a>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info justify-content-between d-flex">
                        <h4>Employee List</h4>
                    </div>
        
                    <div class="card-body">
                        <table class="table table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th >ID</th>
                              <th > Name</th>
                              <th >Email</th>
                              <th >Designation</th>
                              <th >Phone</th>
                              <th >Status</th>
                              <th >Action</th>
                            </tr>
                          </thead>
                          <tbody>
                      @foreach ( $employee_lists as $employee_list)
                      <tr>
                        <input type="hidden" value="{{$employee_list->id}}" class="em_del">
                        <td>{{$employee_list->id}}</td>   
                        <td>{{$employee_list->name}}</td>    
                        <td>{{$employee_list->email}}</td>    
                        <td>{{$employee_list->designation}}</td>    
                        <td>{{$employee_list->phone}}</td>       
                        <td>
                        <a href="javascript:void(0);" onclick="emstatus_change({{$employee_list->id}})" id="statusbadge">
                            @if($employee_list->status==1)
                            <span class="badge bg-primary" style="color: #fff">Active</span>
                            @else  
                            <span class="badge bg-danger" style="color: #fff">Deactive</span> 
                            @endif
                        </a>
                        </td>       
                        <td>
                            <a class="btn btn-primary btn-sm" onclick="" type="button" id="" name=""><i class="fa-solid fa-pen-to-square"></i></a>
                              
                            <button type="submit"class="btn btn-danger btn-sm employee_delete"><i class="fa-solid fa-trash-can"></i></button>
                        </td>       
                    </tr>
                      @endforeach    
                          </tbody>
                      </table>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
   @include('ToDo_List.modal.employee')
@endsection
@section('scripts')
   <script>
    $(document).ready(function () {
        $('#emSave').click(function () {
            var em_name =$('#em_name').val();
            var em_email =$('#em_email').val();
            var em_password =$('#em_password').val();
            var em_designation =$('#em_designation').val();
            var em_phone =$('#em_phone').val();
            var em_status =$('#em_status').val();
           $.ajax({
            headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
            type: 'post',
            url: '/add/employee',
            data: {
                em_name: em_name,
                em_email: em_email,
                em_password: em_password,
                em_designation: em_designation,
                em_phone: em_phone,
                em_status: em_status
            },
            
            success: function (response) {
              if(response){
                // console.log(response);
                $('#employeemodal').modal('hide');
              } 
            },
            error: function (error){
            if(error.responseJSON && error.responseJSON.errors){
            var errors = error.responseJSON.errors;
            if(errors.em_password){
              $('#em_password').addClass('is_invalid');
              $('#vali_pass').text(errors.em_password[0]);
              
            }else{
                $('#em_password').removeClass('is_invalid');
              $('#vali_pass').text('');
            }

            if(errors.em_email){
              $('#em_email').addClass('is_invalid');
              $('#vali_email').text(errors.em_email[0]);
              
            }else{
                $('#em_email').removeClass('is_invalid');
                 $('#vali_email').text('');
            }

            if(errors.em_name){
              $('#em_name').addClass('is_invalid');
              $('#vali_name').text(errors.em_name[0]);
              
            }else{
                $('#em_name').removeClass('is_invalid');
              $('#vali_name').text('');
            }
          }
                console.log(error)
            }
           }); 
        });
    });
   </script>
   {{-- status change --}}
   <script>
    function emstatus_change(id){
        Swal.fire({
            title: 'Are you sure to change the status?',
            icon: 'warning',
            showCancelButton: true,
            width: 300,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                   $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: '{{ route('employee.status') }}',
                    data: {
                        id: id
                    },
                    success: function (response) {
                       // Status changed successfully
                       Swal.fire({title: response.status,
                               icon: "success",
                               width: 300,}).then(function () {
                               location.reload();
                              
                    });
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    }
   </script>
   <script>
    $(document).ready(function () {
      $('.employee_delete').click(function (el) {
            el.preventDefault();
            var employee_id = $(this).closest("tr").find('.em_del').val();
            Swal.fire({
             title: 'Are you sure to delete this Employee?',
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
                     url: '/user/delete/' + employee_id,
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