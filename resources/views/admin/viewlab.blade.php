@extends('layouts.admin')
@section('pageTitle', "Laboratory's Report")
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title"> 
          <h1>Laboratory's Report</h1>
          <ol class="breadcrumb hidden-xs">
              <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
              <li class="active">Laboratory's Report</li>
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
                </div>


                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-12">
                        <div style="background:#009688; height: 60px; text-align: center; color: white">
                          <h4 style="padding: 20px">Laboratory Report</h4>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover">
                            <tr>
                              <th>Lab Report ID</th>
                              <td>{{ $report->lab_report_id }}</td>
                            </tr>
                            <tr>
                              <th>Doctor's Report ID'</th>
                              <td><a href="{{ url('/viewreport') }}/?report_id={{ $report->doctor_report_id }}" target="_blank">{{ $report->doctor_report_id }}</a></td>
                            </tr>
                            <tr>
                              <th>Personel-In-Carge</th>
                              <td>
                                {{ $report->lab_scientist_id }}
                              </td>
                            </tr>
                          
                            <tr>
                              <th>The Report</th>
                              <td>{{ $report->lab_report}}</td>
                            </tr>
                         
                            <tr>
                              <th>Date of Report</th>
                              <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->created_at))->toFormattedDateString() }}</td>
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
@endsection