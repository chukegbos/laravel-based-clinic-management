@extends('layouts.admin')
@section('pageTitle', 'Dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-tachometer"></i>
        </div>
        <div class="header-title">
            <h1> Dashboard</h1>
            <small> Dashboard features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        @if(Auth::user()->role=="Doctor")
            <div class="row">             
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>My Schedule</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Days</th>
                                            <th>Start time</th>
                                            <th>End time</th>
                                            <!--<th>Status</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Monday</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->start_time1) }}</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->end_time1) }}</td>
                                            <!--<td>
                                                @if($doctor->monday==NULL)
                                                    <span class="label-default label label-danger">Inactive</span>
                                                    <a href="{{ url('/') }}/actionschedule/?unique_id={{ $doctor->unique_id }}&" class="label-default label label-info"><i class="fa fa-check"></i> Set Active</a>
                                                @else
                                                    <span class="label-default label label-info">Active</span>
                                                    <a href="{{ url('/') }}/actionschedule/?unique_id={{ $doctor->unique_id }}" class="label-default label label-danger"><i class="fa fa-times"></i> Set Inactive</a>
                                                @endif
                                            </td>-->
                                        </tr>

                                        <tr>
                                            <td>Tuesday</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->start_time2) }}</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->end_time2) }}</td>
                                            <!--<td>
                                                @if($doctor->tuesday==NULL)
                                                    <span class="label-default label label-danger">Inactive</span>
                                                @else
                                                    <span class="label-default label label-info">Active</span>
                                                @endif
                                            </td>-->
                                        </tr>

                                        <tr>
                                            <td>Wednesday</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->start_time3) }}</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->end_time3) }}</td>
                                            <!--<td>
                                                @if($doctor->wednesday==NULL)
                                                    <span class="label-default label label-danger">Inactive</span>
                                                @else
                                                    <span class="label-default label label-info">Active</span>
                                                @endif
                                            </td>-->
                                        </tr>

                                        <tr>
                                            <td>Thursday</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->start_time4) }}</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->end_time4) }}</td>
                                            <!--<td>
                                                @if($doctor->thursday==NULL)
                                                    <span class="label-default label label-danger">Inactive</span>
                                                @else
                                                    <span class="label-default label label-info">Active</span>
                                                @endif
                                            </td>-->
                                        </tr>

                                        <tr>
                                            <td>Friday</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->start_time5) }}</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->end_time5) }}</td>
                                            <!--<td>
                                                @if($doctor->friday==NULL)
                                                    <span class="label-default label label-danger">Inactive</span>
                                                @else
                                                    <span class="label-default label label-info">Active</span>
                                                @endif
                                            </td>-->
                                        </tr>

                                        <tr>
                                            <td>Saturday</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->start_time6) }}</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->end_time6) }}</td>
                                            <!--<td>
                                                @if($doctor->saturday==NULL)
                                                    <span class="label-default label label-danger">Inactive</span>
                                                @else
                                                    <span class="label-default label label-info">Active</span>
                                                @endif
                                            </td>-->
                                        </tr>

                                        <tr>
                                            <td>Sunday</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->start_time7) }}</td>
                                            <td><span class="glyphicon glyphicon-time"></span> {{ sprintf("%7.2f", $doctor->end_time7) }}</td>
                                            <!--<td>
                                                @if($doctor->sunday==NULL)
                                                    <span class="label-default label label-danger">Inactive</span>
                                                @else
                                                    <span class="label-default label label-info">Active</span>
                                                @endif
                                            </td>-->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Today's Appointments</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example4" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Patient</th>
                                            <!--<th>Booked By</th>-->
                                            <th>Last Visit</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            
                                            <!--<th>Delete</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $report)
                                        <tr>
                                            <td>
                                                <label>
                                                    @forelse($user1 as $user)
                                                        @if($report->unique_id==$user->unique_id)
                                                            {{ $user->lname }} {{ $user->fname }} {{ $user->mname }}
                                                            @if($report->first_timer=="Yes")
                                                                <a href="{{ url('/') }}/viewpatient/?unique_id={{ $user->unique_id }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> New patient</a> 
                                                            @endif
                                                        @endif

                                                    @empty
                                                    @endforelse
                                                    
                                                </label>   
                                            </td>

                                            <!--<td>
                                                <label>{{ $report->doctor_id }}</label>   
                                            </td>-->

                                            <td>
                                                <label>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->created_at))->toFormattedDateString() }}</label>
                                            </td>
                                            <td>
                                                <label>{{ $report->status }}</label>
                                            </td>
                                            <td>
                                                <label>
                                                    <a href="{{ url('/viewreport') }}/?report_id={{ $report->report_id }}" class="btn btn-info btn-xs">View Report</a>
                                                </label>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.row -->
        @elseif(Auth::user()->role=="Admin")
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="{{ url('/alldoctors') }}">
                                <div class="panel panel-bd cardbox">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $countdoctor }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-user fa-2x"></i>
                                            <h4>All Doctors </h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="{{ url('/stafflist') }}/?staff=Nurse">
                                <div class="panel panel-bd cardbox">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $allnurses }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-user-circle-o fa-2x"></i>
                                            <h4>All Nurses</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="{{ url('/stafflist') }}">
                                <div class="panel panel-bd cardbox">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $stafflist }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-user-circle fa-2x"></i>
                                            <h4>All Staff</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="{{ url('/alldepartments') }}">
                                <div class="panel panel-bd cardbox">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $units }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                        <i class="fa fa-handshake-o fa-2x"></i>
                                        <h4>Units</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="{{ url('/allpatients') }}">
                                <div class="panel panel-bd cardbox">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $allpatients }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-users fa-2x"></i>
                                            <h4>Ledger/Files</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="{{ url('/allpatients') }}/?type=outpatient">
                                <div class="panel panel-bd cardbox">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $outpatients }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-users fa-2x"></i>
                                            <h4>Out Patients</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="{{ url('/allpatients') }}/?type=inpatient">
                                <div class="panel panel-bd cardbox">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $inpatients }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-user-circle fa-2x"></i>
                                            <h4>In-Patients</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>        
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="{{ url('/appointments') }}/?today=now">
                                <div class="panel panel-bd cardbox">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $appointment }}</span>
                                            </h2>
                                        </div>
                                        <div class="items">
                                            <i class="fa fa-users fa-2x"></i>
                                            <h4>Today's Appointments</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4" style="background: white; padding: 10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>{{ $setting->sitename }}</h4>
                            </div>
                        </div>
                        <div class="panel-body" style="text-align: justify;">
                            <p><i class="hvr-buzz-out fa fa-envelope"></i> {{ $setting->address}}</p>
                            <p><i class="hvr-buzz-out fa fa-phone"></i> {{ $setting->phone}}</p>
                            <p><i class="hvr-buzz-out fa fa-envelope-open"></i> {{ $setting->email}}</p>
                            <hr>
                            <p>Date of Last Renew: <b>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($setting->date_activate))->toFormattedDateString() }}</b></p>
                            <p>License Expiration Date: <b>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($setting->date_expire))->toFormattedDateString() }}</b></p>
                            <hr>                          
                        </div>
                        <div class="panel-footer">
                            <p>Alrights reserved</p>
                            <a href="#">About SMIS</a> | 
                            <a href="#">Contact</a> | 
                            <a href="#">FAQ</a> | 
                            <a href="#">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Today's Appointments</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example4" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Patient</th>
                                            <th>Last Visit</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $report)
                                        <tr>
                                            <td>
                                                <label>
                                                    @forelse($user1 as $user)
                                                        @if($report->unique_id==$user->unique_id)
                                                            {{ $user->lname }} {{ $user->fname }} {{ $user->mname }}
                                                            @if($report->first_timer=="Yes")
                                                                <a href="{{ url('/') }}/viewpatient/?unique_id={{ $user->unique_id }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> New patient</a> 
                                                            @endif
                                                        @endif

                                                    @empty
                                                    @endforelse
                                                    
                                                </label>   
                                            </td>


                                            <td>
                                                <label>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->created_at))->toFormattedDateString() }}</label>
                                            </td>
                                            <td>
                                                <label>{{ $report->status }}</label>
                                            </td>
                                            <td>
                                                <label>
                                                    <a href="{{ url('/viewreport') }}/?report_id={{ $report->report_id }}" class="btn btn-info btn-xs">View Report</a>
                                                </label>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> /row -->
        @elseif(Auth::user()->role=="Pharmacist")
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <a href="{{ url('/drugcat') }}">
                        <div class="panel panel-bd bg-green" style="color: white">
                            <div class="panel-body">
                                <div class="statistic-box">
                                    <div class="small pull-left">
                                        <span style="font-size: 25px; color: white">Medicine Category </span><br>
                                        <span style="font-size: 10px; color: white">Total Medicine Category in Store.</span>
                                    </div>
                                    
                                    <div>
                                        <i class="hvr-buzz-out fa fa-dribbble" style="font-size: 60px"> </i>
                                        <h2><span class="count-number">{{ $drugcat }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-3">
                    <a href="{{ url('/alldrugs') }}">    
                        <div class="panel panel-bd" style="color: white; background: orange">
                            <div class="panel-body">
                                <div class="statistic-box">
                                    <div class="small pull-left">
                                        <span style="font-size: 25px; color: white">All Medicine/Drugs</span><br>
                                        <span style="font-size: 10px; color: white">Total Medicine in Store.</span>
                                    </div>
                                    
                                    <div>
                                        <i class="fa fa-medkit" aria-hidden="true"  style="font-size: 60px"></i>
                                        <h2><span class="count-number">{{ $drug }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-3">
                    <a href="{{ url('/orders') }}">
                        <div class="panel panel-bd" style="color: white; background: blue">
                            <div class="panel-body">
                                <div class="statistic-box">
                                    <div class="small pull-left">
                                        <span style="font-size: 25px; color: white">Overall Transactions</span><br>
                                        <span style="font-size: 10px; color: white">Total Transaction in Store.</span>
                                    </div>
                                    
                                    <div>
                                        <i class="fa fa-money" aria-hidden="true"  style="font-size: 60px"></i>
                                        <h2><span class="count-number">{{ $orders }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                  
                <div class="col-sm-6 col-md-3">
                    <a href="{{ url('/orders') }}/?today=today"> 
                        <div class="panel panel-bd" style="color: white; background: black">
                            <div class="panel-body">
                                <div class="statistic-box">
                                    <div class="small pull-left">
                                        <span style="font-size: 25px; color: white">Today's Transactions </span><br>
                                        <span style="font-size: 10px; color: white">Total Transaction Done Today.</span>
                                    </div>
                                    
                                    <div>
                                        <i class="hvr-buzz-out fa fa-dribbble" style="font-size: 60px"> </i>
                                        <h2><span class="count-number">{{ $todayorders }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-3">
                    <a href="{{ url('/orders') }}/?week=week"> 
                        <div class="panel panel-bd" style="color: white; background: #e20dd4">
                            <div class="panel-body">
                                <div class="statistic-box">
                                    <div class="small pull-left">
                                        <span style="font-size: 25px; color: white">This Week's Transactions </span><br>
                                        <span style="font-size: 10px; color: white">Total Transaction Done This Week.</span>
                                    </div>
                                    
                                    <div>
                                        <i class="fa fa-medkit" aria-hidden="true"  style="font-size: 60px"></i>
                                        <h2><span class="count-number">{{ $weekorders }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-3">
                    <a href="{{ url('/orders') }}/?month=month"> 
                        <div class="panel panel-bd" style="color: white; background: #8e6969">
                            <div class="panel-body">
                                <div class="statistic-box">
                                    <div class="small pull-left">
                                        <span style="font-size: 25px; color: white">This Months's Transactions</span><br>
                                        <span style="font-size: 10px; color: white">Total Transaction Done This Month.</span>
                                    </div>
                                    
                                    <div>
                                        <i class="fa fa-money" aria-hidden="true"  style="font-size: 60px"></i>
                                        <h2><span class="count-number">{{ $monthorders }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                  
                <div class="col-sm-6 col-md-3">
                    <a href="{{ url('/orders') }}/?year=year"> 
                        <div class="panel panel-bd" style="color: white; background: grey">
                            <div class="panel-body">
                                <div class="statistic-box">
                                    <div class="small pull-left">
                                        <span style="font-size: 25px; color: white">This Year's Transactions </span><br>
                                        <span style="font-size: 10px; color: white">Total Transaction Done This Year.</span>
                                    </div>
                                    
                                    <div>
                                        <i class="hvr-buzz-out fa fa-dribbble" style="font-size: 60px"> </i>
                                        <h2><span class="count-number">{{ $yearorders }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @elseif(Auth::user()->role=="Lab Scientist")
            <div class="row">
                <div class="col-sm-6 col-md-9">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <a href="{{ url('/laborders') }}">
                                <div class="panel panel-bd bg-green" style="color: white">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <div class="small pull-left">
                                                <span style="font-size: 25px; color: white">Laboratory Request </span><br>
                                                <span style="font-size: 10px; color: white">Total Unattended Laboratory Request</span>
                                            </div>
                                            
                                            <div>
                                                <h2><span class="count-number">{{ $labrequest }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <a href="{{ url('/alldrugs') }}">    
                                <div class="panel panel-bd" style="color: white; background: orange">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <div class="small pull-left">
                                                <span style="font-size: 25px; color: white">Booked Laboratory Test </span><br>
                                                <span style="font-size: 10px; color: white">Already booked but pending lab request.</span>
                                            </div>
                                            
                                            <div>
                                                <h2><span class="count-number">{{ $bookedlab }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <a href="{{ url('/orders') }}">
                                <div class="panel panel-bd" style="color: white; background: blue">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <div class="small pull-left">
                                                <span style="font-size: 25px; color: white">Concluded Results</span><br>
                                                <span style="font-size: 10px; color: white">Total Results that are ready.</span>
                                            </div>
                                            
                                            <div>
                                                <h2><span class="count-number">{{ $readylab }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-sm-6 col-md-4">
                            <a href="{{ url('/laborders') }}">
                                <div class="panel panel-bd bg-green" style="color: white">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <div class="small pull-left">
                                                <span style="font-size: 25px; color: white">Laboratory Request </span><br>
                                                <span style="font-size: 10px; color: white">Total Unattended Laboratory Request</span>
                                            </div>
                                            
                                            <div>
                                                <h2><span class="count-number">{{ $labrequest }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <a href="{{ url('/alldrugs') }}">    
                                <div class="panel panel-bd" style="color: white; background: orange">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <div class="small pull-left">
                                                <span style="font-size: 25px; color: white">Booked Laboratory Test </span><br>
                                                <span style="font-size: 10px; color: white">Already booked but pending lab request.</span>
                                            </div>
                                            
                                            <div>
                                                <h2><span class="count-number">{{ $bookedlab }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <a href="{{ url('/orders') }}">
                                <div class="panel panel-bd" style="color: white; background: blue">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <div class="small pull-left">
                                                <span style="font-size: 25px; color: white">Concluded Results</span><br>
                                                <span style="font-size: 10px; color: white">Total Results that are ready.</span>
                                            </div>
                                            
                                            <div>
                                                <h2><span class="count-number">{{ $readylab }}</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span> </h2>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3" style="background: white; padding: 10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>{{ $setting->sitename }}</h4>
                            </div>
                        </div>
                        <div class="panel-body" style="text-align: justify;">
                            <p><i class="hvr-buzz-out fa fa-envelope"></i> {{ $setting->address}}</p>
                            <p><i class="hvr-buzz-out fa fa-phone"></i> {{ $setting->phone}}</p>
                            <p><i class="hvr-buzz-out fa fa-envelope-open"></i> {{ $setting->email}}</p>
                            <hr>
                            <p>Date of Last Renew: <b>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($setting->date_activate))->toFormattedDateString() }}</b></p>
                            <p>License Expiration Date: <b>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($setting->date_expire))->toFormattedDateString() }}</b></p>
                            <hr>                          
                        </div>
                        <div class="panel-footer">
                            <p>Alrights reserved</p>
                            <a href="#">About SMIS</a> | 
                            <a href="#">Contact</a> | 
                            <a href="#">FAQ</a> | 
                            <a href="#">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section> <!-- /.content -->
</div> 

<div id="adddrug" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Add Drug</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd lobidrag">
                <div class="panel-body">
                    <form class="col-sm-12" method="POST" action="{{ url('/alldrugs') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Medicine Category</label>
                            <select class="form-control" name="category">
                                @forelse($medicats as $medicat)
                                    <option value="{{ $medicat->id }}">{{ $medicat->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" class="form-control" name="brand_name" placeholder="Emzor" required>
                        </div>
                        <div class="form-group">
                            <label>Genetic Name</label>
                            <input type="text" class="form-control" name="genetic_name" placeholder="Paracetamol" required>
                        </div>
                       
                        <div class="form-group">
                            <label>NAFDAC Number</label>
                            <input type="text" class="form-control" name="nafdac_number" required>
                        </div>
                        <div class="form-group">
                            <label>Batch Number</label>
                            <input type="text" class="form-control" name="batch_number" required>
                        </div>
                        
                     
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="date" class="form-control" name="expiry_date" required>
                        </div>
                        <div class="form-group">
                            <label>Regular Price (Amount meant to be sold)</label>
                            <input type="number" class="form-control" name="reg_price" required>
                        </div>

                        <div class="form-group">
                            <label>Discount Price (Amount to be sold)</label>
                            <input type="number" class="form-control" name="discount_price" required>
                        </div>
                     
                       <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>

                        <div class="reset button">
                             <a href="#" class="btn btn-primary">Reset</a>
                             <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
@endsection