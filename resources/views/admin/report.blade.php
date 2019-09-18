@extends('layouts.admin')
@section('pageTitle', 'Report')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title"> 
            <h1>Report</h1>
            <small>Report list</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Reports</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            @if(isset($unique_id) && (Auth::user()->role=="Doctor"))
                            <a class="btn btn-success" href="{{ url('addreport') }}/?unique_id={{$unique_id}}"> <i class="fa fa-plus"></i> Add Report
                            </a>  
                            @endif
                        </div>        
                    </div>
                    <div class="panel-body">
                        @if(isset($status))
                          <div class="alert alert-success alert-dismissable" style="margin:20px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                              {{ $status}}
                          </div>
                        @endif

                        @if(isset($error))
                          <div class="alert alert-danger alert-dismissable" style="margin:20px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4>  <i class="icon fa fa-times"></i> Oops!</h4>
                              {{ $error}}
                          </div>
                        @endif

                        <div class="table-responsive">
                            <table id="example4" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Report  ID</th>
                                        <th>Patient</th>
                                        <th>Doctor/Staff</th>                
                                        <th>Operation?</th>
                                        <th>Lab Test?</th>
                                        <th>Date of Report</th>
                                        <th>Action</th>
                                        
                                        <!--<th>Delete</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reports as $report)
                                    <tr>
                                        <td>
                                            <label>{{ $report->report_id }}</label>   
                                        </td>
                                        <td>
                                            <label>
                                                @forelse($users as $user)
                                                    @if($report->unique_id==$user->unique_id)
                                                        {{ $user->lname }} {{ $user->fname }}{{ $user->mname }}
                                                    @endif
                                                @empty
                                                @endforelse

                                            </label>   
                                        </td>

                                        <td>
                                            <label>{{ $report->doctor_id }}</label>   
                                        </td>

                                        <td>
                                            <label>{{ $report->operation }}</label>
                                            <!--@if ($report->operation=="Yes")
                                                <a href="{{ url('/') }}/report/?unique_id={{ $report->unique_id }}">View Result</a>
                                            @endif-->
                                        </td>
                                        <td>
                                            <label>{{ $report->lab_test }}</label> 
                                            <!--@if ($report->lab_test=="Yes")
                                                <a href="{{ url('/') }}/report/?unique_id={{ $report->unique_id }}">View Result</a>
                                            @endif-->
                                        </td>
                                        <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->created_at))->toFormattedDateString() }}</td>
                                        <td>
                                            <label>
                                                <a href="{{ url('/viewreport') }}/?report_id={{ $report->report_id }}" class="btn btn-warning btn-xs">View</a>
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
        </div>
    </section>
</div>

@endsection