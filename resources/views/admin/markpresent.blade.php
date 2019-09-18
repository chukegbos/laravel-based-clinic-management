@extends('layouts.admin')
@section('pageTitle', 'Book Patient')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">  
        <h1>Book Patient For Consultation</h1>
        <small></small>
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Book Patient</li>
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
                      <form class="col-sm-12" method="POST" action="{{ url('markpresent') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                          <input type="hidden" name="appointment_id" value="{{ $appointment_id }}">
                          <input type="hidden" name="report_id" value="{{ $report->id }}">
                          <div class="col-sm-6 form-group">
                              <label>Patient ID</label>
                              <input type="text" class="form-control" readonly="True" name="unique_id" value="{{ $patient->unique_id }}">
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Patient Name</label>
                              <input type="text" class="form-control" readonly="True" name="bit_rate" value="{{ $patient->fname }} {{ $patient->lname }}">
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Sugar Content</label>
                              <input type="text" class="form-control" required name="sugar_content" placeholder="Put Patient Current Sugar Content">
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Bit Rate</label>
                              <input type="text" class="form-control" required name="bit_rate" placeholder="Put Patient Current Bit Rate">
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Blood Pressure</label>
                              <input type="text" class="form-control" name="hbp" placeholder="Put Patient Current Blood Pressure">
                          </div>


                          <div class="col-sm-6 form-group">
                            <label>Consultation Fee</label>
                            <select class="js-example-basic-single form-control" name="service_id" required="">
                            <!--<select name="department" class="form-control" id="exampleSelect1" name="select" size="1">-->
                              <option>Select Consultation Fee</option>
                              @forelse($services as $service)
                                <option value="{{ $service->id }}">{{$service->name}} ({{$service->quantity}})</option>
                              @empty
                              @endforelse
                            </select> 
                          </div>

                          <div class="col-sm-12 reset-button">
                            <button class="btn btn-success" type="submit">Save</button>
                          </div>

                       </form>
                   </div>
               </div>
           </div>
       </div>   
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection