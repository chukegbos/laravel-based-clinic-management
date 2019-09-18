@extends('layouts.admin')
@section('pageTitle', 'Add Patient')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">  
        <h1>Patient</h1>
        <small>Add Patient</small>
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Add Patient</li>
        </ol>
      </div>
  </section>
  <!-- Main content -->
  <section class="content">
      <div class="row">
          <!-- Form controls -->
          <div class="col-sm-12">
              <div class="panel panel-bd lobidrag">
                  <div class="panel-heading">
                      <div class="btn-group"> 
                          <a class="btn btn-primary" href="{{ url('/allpatients') }}"> <i class="fa fa-list"></i>  Patient List </a>  
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
                      <form class="col-sm-12" method="POST" action="{{ url('patients') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                          <input type="hidden" name="unique_id" value="{{ $random_number }}">

                        
                          <div class="col-sm-4 form-group">
                              <label>First Name</label>
                              <input type="text" class="form-control" placeholder="Enter firstname" required name="fname">
                          </div>
                          <div class="col-sm-4 form-group">
                              <label>Middle Name</label>
                              <input type="text" class="form-control" placeholder="Enter firstname" required name="mname">
                          </div>

                          <div class="col-sm-4 form-group">
                              <label>Last Name</label>
                              <input type="text" class="form-control" placeholder="Enter Lastname" required name="lname">
                          </div>

                          <div class="col-sm-3 form-group">
                              <label>Username</label>
                              <input type="text" class="form-control" placeholder="Enter firstname" required name="uname">
                          </div>

                          <div class="col-sm-3 form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" placeholder="Enter Email" required name="email">
                          </div>
                          <div class="col-sm-3 form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" placeholder="Enter password" required name="password">
                          </div>

                        <div class="col-sm-3 form-group">
                              <label>Mobile Number</label>
                              <input type="tel" name="phone" class="form-control" placeholder="Enter Mobile" required>
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Address</label>
                              <textarea id="some-textarea" name="address" class="form-control" placeholder="Enter text ..."></textarea>
                          </div>

                      
                          


                          <div class="col-sm-6 form-group">
                              <label>Short Biography</label>
                              <textarea id="some-textarea" name="bio" class="form-control" placeholder="Enter text ..."></textarea>
                          </div>        
                          <div class="col-sm-4 form-group">
                              <label>Date of Birth</label>
                              <input  class="datepicker form-control hasDatepicker" type="date" name="dob" placeholder="Date of Birth" id="date_of_birth">
                          </div>
                          <div class="col-sm-4 form-group">
                              <label>Genotype</label>
                              <select class="form-control" name="genotype" id="exampleSelect">
                                  <option value="AA">AA</option>
                                  <option value="AS">AS</option>
                                  <option value="SS">SS</option>
                              </select>
                          </div>

                          <div class="col-sm-4 form-group">
                              <label>Blood group</label>
                              <select class="form-control" name="blood_group" id="exampleSelect">
                                  <option value="A+">A+</option>
                                  <option value="AB+">AB+</option>
                                  <option value="O+">O+</option>
                                  <option value="AB">AB-</option>
                                  <option value="B+">B+</option>
                                  <option value="A-">A-</option>
                                  <option value="B-">B-</option>
                                  <option value="O-">O-</option>
                              </select>
                          </div>

                          <div class="col-sm-3 form-group">
                            <label>Gender</label><br>
                            <label class="radio-inline">
                              <input type="radio" name="gender" value="Male" checked="checked">Male
                            </label> 
                            <label class="radio-inline">
                              <input type="radio" name="gender" value="Female" >Female
                            </label>
                          </div>


                          <div class="col-sm-6 form-group">
                            <label>Marital Status</label><br>
                            <label class="radio-inline">
                              <input type="radio" name="marital_status" value="Single" checked="checked">Single
                            </label> 
                            <label class="radio-inline">
                              <input type="radio" name="marital_status" value="Married">Married
                            </label> 
                            <label class="radio-inline">
                              <input type="radio" name="marital_status" value="Divorced">Divorced
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="marital_status" value="Widow/Widower">Widow/Widower
                            </label>
                          </div>


                          <div class="col-sm-3 form-check">
                            <label>Account Status</label><br>
                            <label class="radio-inline"><input type="radio" name="status" value="1" checked="checked">Active</label> 
                            <label class="radio-inline">
                            <input type="radio" name="status" value="0" >Inctive</label>  
                          </div> 


                            <br>
                          <div class="col-sm-4 form-group">
                              <label>Sugar Content</label>
                              <input type="text" class="form-control" required name="sugar_content">
                          </div>

                          <div class="col-sm-4 form-group">
                              <label>Bit Rate</label>
                              <input type="text" class="form-control" required name="bit_rate">
                          </div>
                          <div class="col-sm-4 form-group">
                              <label>Blood Pressure</label>
                              <input type="text" class="form-control" name="hbp">
                          </div>

                          <div class="col-sm-4 form-group">
                              <label>Problem Scope</label>
                              <textarea id="some-textarea" name="problem_scope" rows="1" class="form-control" placeholder="Enter text ..."></textarea>
                          </div>  

                          <div class="col-sm-4 form-group">
                            <label>Department/Unit In-Charge</label>
                            <select class="js-example-basic-single form-control" name="department">
                            <!--<select name="department" class="form-control" id="exampleSelect1" name="select" size="1">-->
                              @forelse($departmentss as $department)
                                <option value="{{ $department->name }}">{{$department->name}}</option>
                              @empty
                              @endforelse
                            </select> 
                          </div>

                          <div class="col-sm-4 form-group">
                            <label>Card Purchase Fee</label>
                            <select class="js-example-basic-single form-control" name="service_id" required="">
                            <!--<select name="department" class="form-control" id="exampleSelect1" name="select" size="1">-->
                              @forelse($services as $service)
                                <option value="{{ $service->id }}">{{$service->name}} ({{$service->quantity}})</option>
                              @empty
                              @endforelse
                            </select> 
                          </div>

                          <div class="col-sm-12 reset-button">
                            <button class="btn btn-warning" type="reset">Reset</button>
                            <button class="btn btn-warning" type="submit">Save</button>
                          </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>   
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection