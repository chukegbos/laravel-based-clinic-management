@extends('layouts.admin')
@section('pageTitle', "Doctor's Report")
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title"> 
          <h1>Doctor's Report</h1>
          <small></small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
              <li class="active">Doctor's Report</li>
          </ol>
      </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- Form controls -->
      <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
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

              <div style="border-style: solid; border-color: #776969;">

                <div class="row">
                  <div class="col-sm-2">
                    <img src="{{ asset('assets/img/logo.jpg') }}" class="img-responsive" alt="" style="height: ">
                  </div>
                  <div class="col-sm-8">
                      <p style="text-align:center; font-size: 25px; font-weight: bold;">{{ strtoupper($setting->sitename) }}</p>   
                      <p style="text-align:center; margin-top: 10px; font-size: 15px; font-weight: bold;">Address: {{ ucwords($setting->address) }} <br>{{ $setting->email }}<br>{{ $setting->phone }}</p>
                  </div> 
                  @if(Auth::user()->role=="Doctor")
                    <div class="col-sm-1">
                      <!--<div style="padding: 5px" >
                        <button class="btn btn-success pull-right" onclick="myFunction()">Print Report</button>
                      </div>-->  
                      <div class="btn-group"> 
                        <a class="btn btn-success" href="{{ url('addreport')}}/?unique_id={{$report->unique_id}}&report_id={{$report->report_id}}"> <i class="fa fa-plus"></i> Add Report</a>  
                      </div>
                    </div> 

                    @elseif(Auth::user()->role=="Lab Scientist")
                    <div class="col-sm-1">
                      <!--<div style="padding: 5px" >
                        <button class="btn btn-success pull-right" onclick="myFunction()">Print Report</button>
                      </div>-->  
                      <div class="btn-group" style="margin-top: 10px"> 
                        <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#booklab"><i class="fa fa-plus"></i> Book For Lab</a>  
                      </div>
                    </div> 
                  @elseif(isset($bed))
                    <div class="col-sm-1">
                      <!--<div style="padding: 5px" >
                        <button class="btn btn-success pull-right" onclick="myFunction()">Print Report</button>
                      </div>-->  
                      <div class="btn-group" style="padding: 10px"> 
                        <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#bed">
                          <i class="fa fa-plus"></i> Assign Bed
                        </a> 
                      </div>
                    </div> 
                  @endif
                </div>


                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-12">
                        <div style="background:#009688; height: 60px; text-align: center; color: white">
                          <h4 style="padding: 20px">Doctor's View Report</h4>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover">
                            <tr>
                              <th>Report ID</th>
                              <td>{{ $report->report_id }}</td>
                            </tr>
                            <tr>
                              <th>
                                @if($appointment->first_timer==NULL)
                                  Reporting Doctor
                                @else
                                  Reporting Staff
                                @endif
                              </th>
                              <td>{{ $report->doctor_id }}</td>
                            </tr>
                            <tr>
                              <th>Patients</th>
                              <td>
                                @forelse($users as $user)
                                    @if($report->unique_id==$user->unique_id)
                                        {{ $user->lname }} {{ $user->fname }}{{ $user->mname }}
                                    @endif
                                @empty
                                @endforelse
                              </td>
                            </tr>
                            <tr>
                              <th>Patients Problem</th>
                              <td><span style="color: #009688;">Nature of Problem</span>
                                <p>{{ $report->category}}</p><br><br>
                                <span style="color: #009688;">Descriptin of Problem</span>
                                <p>{{ $report->problem_scope }}</p>
                              </td>
                            </tr>

                            <tr>
                              <th>Sugar Content</th>
                              <td>
                                <p>{{ $report->sugar_content }}</p>
                              </td>
                            </tr>


                            <tr>
                              <th>Blood Pressure</th>
                              <td>
                                <p>{{ $report->hbp}}</p>
                              </td>
                            </tr>


                            <tr>
                              <th>Bit Rate</th>
                              <td>
                                <p>{{ $report->bit_rate }}</p>
                              </td>
                            </tr>


                            <tr>
                              <th>Doctor's Diagnosis</th>
                              <td>
                                <p>{{ $report->diagnosis }}</p>
                                <p>
                                  @if($report->diagnosis!=NULL)
                                    @if($report->controlled=="Yes")
                                      The illness can be controlled
                                    @else
                                      The illness cannot be controlled
                                    @endif
                                  @endif
                                </p>
                              </td>
                            </tr>

                            <tr>
                              <th>Doctor's Recommendation</th>
                              <td>{{ $report->recommendation }}</td>
                            </tr>

                            <tr>
                              <th>Doctor's Prescription</th>
                              <td>{{ $report->prescription }}</td>
                            </tr>

                            <tr>
                              <th>Required Lab Test?</th>
                              <td>{{ $report->lab_test}} 
                                  @if(Auth::user()->role=="Lab Scientist")
                                    @if($report->lab_test_result!=NULL && $report->lab_test_result!="Booked") 
                                      <p class="btn btn-success btn-xs" id="mySelect" onclick="myFunction()">View Result</p>

                                      <a href="{{ url('/operationresult') }}" class="btn btn-success btn-xs">Edit Result</a>

                                    @elseif($report->lab_test_result!=NULL) 
                                      <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#ordine" > <i class="fa fa-plus"></i> Book Test
                                      </a> 
                                    @else
                                      <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#ordine" > <i class="fa fa-plus"></i> Add Lab Result
                                      </a>                                          
                                    @endif 
                                  @elseif(Auth::user()->role=="Doctor")
                                    @if($report->lab_test_result!=NULL) 
                                      <a href="{{ url('/operationresult') }}" class="btn btn-success btn-xs">View Result</a>
                                    @endif
                                  @endif 
                              </td>
                            </tr>

                            <tr>
                              <th>Required Operation?</th>
                              <td>{{ $report->operation}} @if($report->operation_result!=NULL) <a href="{{ url('/operationresult') }}">View Result</a> @endif</td>
                            </tr>

                            <tr>
                              <th>Date of Report</th>
                              <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->created_at))->toFormattedDateString() }}</td>
                            </tr>

                            <tr>
                              <th>Date of Next Appointment</th>         
                              <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->checkup))->toFormattedDateString() }}</td>
                            </tr> 
                          </table>         
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <script>
                function myFunction() {
                  window.print();
                }
              </script>
            </div>
        </div>
      </div>
    </div> 
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<div id="booklab" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 1000px;">
    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Laboratory Report</h4>
    </div>
    <div class="modal-body">
      <div class="panel panel-bd">
        <div class="panel-body">
          <form class="col-sm-12" method="POST" action="{{ url('/laborders') }}">
            {{ csrf_field() }}
            <div class="form-group">
              <input type="hidden" name="doctor_report_id" value="{{ $report->report_id }}">
              <input type="hidden" name="lab_report_id" value="{{ $random_number }}">
              <input type="hidden" name="lab_scientist_id" value="{{ Auth::user()->unique_id }}">
              <div class="field_wrapper">
                <div>
                  Name of Test: <input type="text" name="test[]" placeholder="Blood Test" style="margin-right: 10px; width: 500px"/>
                  Amount: <input type="number" name="amount[]" placeholder="1000" style="margin-right: 10px; width: 90px"/>
                  <a href="javascript:void(0);" class="add_button btn btn-success btn-xs">Add a row</a>
                </div>
              </div>
            </div>
            <div class="table-responsive" style="float: right">
              <table class="table table-bordered table-hover">
                <tbody>
                  <tr>
                    <td><label>Subtotal</label></td>
                    <td>$875.00</td>
                  </tr>
                  <tr>
                    <td><label>Total</label></td>
                    <td><label>$875.00</label></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="form-group">
              <label>Mode of Payment</label>
              <select class="form-control">
                <option>Cash</option>
                <option>POS</option>
                <option>Insurance</option>
              </select>
            </div>
            <div class="reset button">
              <input type="submit" value="Save & Print"  class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="ordine" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 1000px;">

        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Laboratory Report</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <form class="col-sm-12" method="POST" action="{{ url('/laborders') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Enter Lab Report</label>
                            <input type="hidden" name="doctor_report_id" value="{{ $report->report_id }}">
                            <input type="hidden" name="lab_report_id" value="{{ $random_number }}">
                            <input type="hidden" name="lab_scientist_id" value="{{ Auth::user()->unique_id }}">

                            <textarea  class="form-control" id="editor1" rows="100" cols="110" name="lab_report">
                             
                            </textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1' );
                            </script>
                        </div>                           
                      
                      <div class="reset button">
                         <input type="submit" value="Save"  class="btn btn-success pull-right">
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection