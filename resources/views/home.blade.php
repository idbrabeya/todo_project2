@extends('layouts.app')
@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Home </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
       
    </ol>
  </div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title mb-4">Project Overview</h4>

                <div class="row">
                    <div class="col-sm-6 col-lg-6 col-xl-3">
                        <div class="card-box mb-0 widget-chart-two">
                            <div class="float-right">
                                <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                       data-fgColor="#0acf97" value="{{$total_admin}}" data-skin="tron" data-angleOffset="180"
                                       data-readOnly=true data-thickness=".1"/>
                            </div>
                            <div class="widget-chart-two-content">
                                <p class="text-muted mb-0 mt-2">Total Admin</p>
                                <h4 class="">
                                    <i class="fa-solid fa-user-tie"></i></i> {{$total_admin}}
                                </h4>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6 col-xl-3">
                        <div class="card-box mb-0 widget-chart-two">
                            <div class="float-right">
                                <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                       data-fgColor="#f9bc0b" value="{{$total_employees}}" data-skin="tron" data-angleOffset="180"
                                       data-readOnly=true data-thickness=".1"/>
                            </div>
                            <div class="widget-chart-two-content">
                                <p class="text-muted mb-0 mt-2">Total Employee</p>
                                <h4 class="">
                                    <i class="fa-solid fa-users"></i> {{$total_employees}}
                                </h4>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6 col-xl-3">
                        <div class="card-box mb-0 widget-chart-two">
                            <div class="float-right">
                                <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                       data-fgColor="#f1556c" value="{{$total_project}}" data-skin="tron" data-angleOffset="180"
                                       data-readOnly=true data-thickness=".1"/>
                            </div>
                            <div class="widget-chart-two-content">
                                <p class="text-muted mb-0 mt-2">Total Project</p>
                                <h4 class="">
                                    <i class="fa-solid fa-briefcase"></i>
                                    {{$total_project}}</h4>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6 col-xl-3">
                        <div class="card-box mb-0 widget-chart-two">
                            <div class="float-right">
                                <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                       data-fgColor="#2d7bf4" value="30" data-skin="tron" data-angleOffset="180"
                                       data-readOnly=true data-thickness=".1"/>
                            </div>
                            <div class="widget-chart-two-content">
                                <p class="text-muted mb-0 mt-2">Total Task</p>
                                <h4 class=""><i class="fa-solid fa-person-digging"></i> 32</h4>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
    <!-- end row -->
</div> <!-- container -->



@endsection
