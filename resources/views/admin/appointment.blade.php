@extends('layouts.admin')
@section('pageTitle', 'Appointment')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-tachometer"></i>
        </div>
        <div class="header-title">
            <h1> All Appointment</h1>
            <small> </small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Appointment</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Appointments</h4>
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
                                        <th>Patient</th>
                                        <th>Date of Appointment</th>
                                        <th>Department</th>
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
                                            @forelse($user1 as $user)
                                                @if($report->unique_id==$user->unique_id)
                                                    {{ $user->lname }} {{ $user->fname }} {{ $user->mname }}
                                                    @if($report->first_timer=="Yes")
                                                        <a href="{{ url('/') }}/viewpatient/?unique_id={{ $user->unique_id }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> New patient</a> 
                                                    @endif
                                                @endif

                                            @empty
                                            @endforelse  
                                        </td>
                                        <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->date_of_appointment))->toFormattedDateString() }}</td>
                                        <td>{{ $report->department }}</td>
                                        <!--<td>
                                            <label>{{ $report->doctor_id }}</label>   
                                        </td>-->

                                        <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->created_at))->toFormattedDateString() }}</td>
                                        <td>{{ $report->status }}</td>
                                        <td>
                                            <a href="{{ url('/viewreport') }}/?report_id={{ $report->report_id }}" class="btn btn-info btn-xs">View Report</a>
                                            <!--<a href="{{ url('/viewreport') }}/?report_id={{ $report->report_id }}" class="btn btn-default btn-xs">Assign Doctor</a>-->
                                            @if($report->date_of_appointment == $today && $report->status != "On Queue")
                                                <a href="{{ url('/markpresent') }}/?report_id={{ $report->report_id }}&appointment_id={{ $report->id }}" class="btn btn-violet btn-xs">Mark Present</a>
                                            @endif
                                            @if($report->status == NULL || $report->status == "On Queue")
                                            <a href="#" data-toggle="modal" data-target="#newdate" class="btn btn-inverse btn-xs">Reschedule Visit</a>
                                            @endif
                                            <div id="newdate" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content ">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Reschedule Visit</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="panel panel-bd lobidrag">
                                                            <div class="panel-body">
                                                                <form class="col-sm-12" method="POST" action="{{ url('/reschedule') }}">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <label>New Date</label>
                                                                        <input type="hidden" name="id" value="{{ $report->id }}">
                                                                        <input type="date" class="form-control" name="date_of_appointment" required>
                                                                    </div>
                                                                    <div class="reset button">
                                                                         <button type="submit" class="btn btn-success">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
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
    </section> <!-- /.content -->
</div> 


@endsection