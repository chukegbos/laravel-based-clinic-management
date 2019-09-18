@extends('layouts.admin')
@section('pageTitle', 'Profile')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
          <h1>Profile</h1>
          <small></small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
              <li class="active">Profile</li>
          </ol>
      </div>
  </section>


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
                  @if(Auth::user()->role=="Admin")
                    <div class="col-sm-1">
                     
                    </div> 
                  @endif
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      @if(isset($patient))
                      <div class="col-sm-12">
                        <div style="background:#009688; height: 60px; text-align: center; color: white">
                          <h4 style="padding: 20px">Patient Profile</h4>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover">
                            <tr>
                              <th>Name</th>
                              <td>{{ $patient->lname }} {{ $patient->fname }} {{ $patient->mname }}</td>
                            </tr>
                            <tr>
                              <th>Patient ID</th>
                              <td>{{ $patient->unique_id }}</td>
                            </tr>
                            <tr>
                              <th>Phone Number</th>
                              <td>{{ $patient->phone }}</td>
                            </tr>
                            <tr>
                              <th>Email</th>
                              <td>{{ $patient->email}}</td>
                            </tr>
                            <tr>
                              <th>Address</th>
                              <td>{{ $patient->address }}</td>
                            </tr>

                            <tr>
                              <th>Date of Birth</th>
                              <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($patient->dob))->toFormattedDateString() }}</td>
                            </tr>

                            <tr>
                              <th>Gender</th>
                              <td>{{ $patient->gender }}</td>
                            </tr>

                            <tr>
                              <th>Biography</th>
                              <td>{{ $patient->bio }}</td>
                            </tr>

                            <tr>
                              <th>Marital Status</th>
                              <td>{{ $patient->marital_status }}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      @elseif(isset($doctor))
                      <div class="col-sm-12">
                        <div style="background:#009688; height: 60px; text-align: center; color: white">
                          <h4 style="padding: 20px">Profile</h4>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover">
                            <tr>
                              <th>Name</th>
                              <td>{{ $doctor->lname }} {{ $doctor->fname }} {{ $doctor->mname }}</td>
                            </tr>
                            <tr>
                              <th>Unique ID</th>
                              <td>{{ $doctor->unique_id }}</td>
                            </tr>
                            <tr>
                              <th>Phone Number</th>
                              <td>{{ $doctor->phone }}</td>
                            </tr>
                            <tr>
                              <th>Email</th>
                              <td>{{ $doctor->email}}</td>
                            </tr>
                            <tr>
                              <th>Address</th>
                              <td>{{ $doctor->address }}</td>
                            </tr>

                            <tr>
                              <th>Date of Birth</th>
                              <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($doctor->dob))->toFormattedDateString() }}</td>
                            </tr>

                            <tr>
                              <th>Gender</th>
                              <td>{{ $doctor->gender }}</td>
                            </tr>

                            <tr>
                              <th>Biography</th>
                              <td>{{ $doctor->bio }}</td>
                            </tr>

                            <tr>
                              <th>Marital Status</th>
                              <td>{{ $doctor->marital_status }}</td>
                            </tr>

                            <tr>
                              <th>Designation</th>
                              <td>{{ $doctor->designation }}</td>
                            </tr>

                            <tr>
                              <th>Department</th>
                              <td>{{ $doctor->department }}</td>
                            </tr>

                            <tr>
                              <th>Specialization</th>
                              <td>{{ $doctor->specialist }}</td>
                            </tr>
                            <tr>
                              <th>Biography</th>
                              <td>{{ $doctor->bio }}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
        </div>
      </div>
    </div> 
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection