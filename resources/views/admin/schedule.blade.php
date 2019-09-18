@extends('layouts.admin')
@section('pageTitle', 'Schedule')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Dr. {{ $doctor->lname }}'s</h1>
            <small>Schedule</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Doctor's Schedule</li>
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
                            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#scmodal" > <i class="fa fa-plus"></i> Edit Schedule
                            </a>  
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
        </div>
    </section>
</div>

<div id="scmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Apply Schedule</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd lobidrag">
                
                <div class="panel-body">
                      <form method="Post" action="{{ url('/updateschedule') }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{ $doctor->id }}">

                                <label>Monday Start Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->start_time1 }}" name="start_time1" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Monday End Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->end_time1 }}" name="end_time1" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tuesday Start Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->start_time2 }}" name="start_time2" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tuesday End Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" id="tuesdayend" value="{{ $doctor->end_time2 }}" name="end_time2">
                            </div>
                        </div>
                        <div class="col-sm-6">                                      
                            <div class="form-group">
                                <label>Wednesday Start Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->start_time3 }}" name="start_time3" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Wednesday End Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->end_time3 }}" name="end_time3" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Thursday Start Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control"value="{{ $doctor->start_time4 }}" name="start_time4" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Thursday End Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->end_time4 }}" name="end_time4" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Friday Start Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->start_time5 }}" name="start_time5" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Friday End Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->end_time5 }}" name="end_time5" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Saturday Start Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->start_time6 }}" name="start_time6" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Saturday End Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->end_time6 }}" name="end_time6" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Sunday Start Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->start_time7 }}" name="start_time7" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Sunday End Time Hour</label>
                                <input type="number" min="1" max="24" class="form-control" value="{{ $doctor->end_time7 }}" name="end_time7" step="0.01">
                            </div>
                        </div>
                        <div class="reset button">
                            <button class="btn btn-success" type="submit">Apply</button>
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

<script>
    //result modal
    $(document).on("click", ".open-AddBookDialog", function () {

     var Id = $(this).data('id');
     var mondaystart = $(this).data('start_time1');
     var mondayend = $(this).data('end_time1');

     var tuesdaystart = $(this).data('start_time2');
     var tuesdayend = $(this).data('end_time2');

     var wednesdaystart = $(this).data('start_time3');
     var wednesdayend = $(this).data('end_time3');

     var thursdaystart = $(this).data('start_time4');
     var thursdayend = $(this).data('end_time4');

     var fridaystart = $(this).data('start_time5');
     var fridayend = $(this).data('end_time5');

     var saturdaystart = $(this).data('start_time6');
     var saturdayend = $(this).data('end_time6');

     var sundaystart = $(this).data('start_time7');
     var sundayend = $(this).data('end_time7');

     $(".modal-body #mainid").val( Id );
     $(".modal-body #Monday_Start").val( mondaystart );
     $(".modal-body #Monday_End").val( mondayend );

     $(".modal-body #Tuesday_Start").val( tuesdaystart );
     $(".modal-body #Tuesday_End").val( tuesdayend );

     $(".modal-body #Wednesday_Start").val( wednesdaystart );
     $(".modal-body #Wednesday_End").val( wednesdayend );

     $(".modal-body #Thursday_Start").val( thursdaystart );
     $(".modal-body #Thursday_End").val( thursdayend );

     $(".modal-body #Friday_Start").val( fridaystart );
     $(".modal-body #Friday_End").val( fridayend );

     $(".modal-body #Saturday_Start").val( saturdaystart );
     $(".modal-body #Saturday_End").val( saturdayend );

     $(".modal-body #Sunday_Start").val( sundaystart );
     $(".modal-body #Sunday_End").val( sundayend );
    $('#scmodal').modal('show');
  });
</script>
@endsection