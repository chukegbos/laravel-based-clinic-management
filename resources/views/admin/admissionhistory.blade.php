@extends('layouts.admin')
@section('pageTitle', 'Admission History')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title"> 
            <h1>Admission</h1>
            <small>Admission History</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Admission History</li>
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
                                        <th>Bed & Ward</th>
                                        <th>Admission Date</th>     
                                        <th>Discharge Date</th>
                                        <th>Duration/Days Spent</th>
                                        <th>Status</th>
                                        <th>Amount Paid</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($admission as $report)
                                    <tr>
                                        <td>
                                            @forelse($user1 as $user)
                                                @if($report->patient_id==$user->unique_id)
                                                    {{ $user->lname }} {{ $user->fname }}{{ $user->mname }}
                                                @endif
                                            @empty
                                            @endforelse 
                                            ({{$report->patient_id}})
                                        </td>
                                        <td>{{ $report->bed }}</td>
                                        <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->start_date))->toFormattedDateString() }} </td>

                                        <td>
                                            @if(isset($report->end_date))
                                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->end_date))->toFormattedDateString() }}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($report->end_date))
                                                {{ \Carbon\Carbon::parse($report->end_date)->diffInDays(\Carbon\Carbon::parse($report->start_date)) }} Days
                                            @else
                                                {{ \Carbon\Carbon::Today()->diffInDays(\Carbon\Carbon::parse($report->start_date)) }} Days
                                            @endif  
                                        </td>
                                        <td>{{ $report->status }}</td>
                                        <td>{{ $report->billing_service }}</td>
                                        <td>
                                            @if($report->status=="Inpatient")
                                                <a href="{{ url('/invoice') }}/?admission_id={{ $report->id }}" class="btn btn-inverse btn-xs">Discharge Patient</a>
                                            @endif
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