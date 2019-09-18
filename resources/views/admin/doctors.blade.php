@extends('layouts.admin')
@section('pageTitle', 'Add Doctor')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="header-icon">
        <i class="pe-7s-note2"></i>
    </div>
    <div class="header-title">
        <h1>Doctor</h1>
        <small>Add Doctor</small>
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Add Doctor</li>
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
                          <a class="btn btn-primary" href="{{ url('/alldoctors') }}"> <i class="fa fa-list"></i>  Doctor List </a>  
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
                      <form class="col-sm-12" method="POST" action="{{ url('doctors') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                          <div class="col-sm-6 form-group">
                              <label>Doctor's Call Number</label>
                              <input type="text"class="form-control" name="unique_id" value="{{ $random_number }}" required="">
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>First Name</label>
                              <input type="text" class="form-control" placeholder="Enter firstname" required name="fname">
                          </div>
                          <div class="col-sm-6 form-group">
                              <label>Middle Name</label>
                              <input type="text" class="form-control" placeholder="Enter firstname" required name="mname">
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Last Name</label>
                              <input type="text" class="form-control" placeholder="Enter Lastname" required name="lname">
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Username</label>
                              <input type="text" class="form-control" placeholder="Enter firstname" required name="uname">
                          </div>
                          <div class="col-sm-6 form-group">
                              <label>Address</label>
                              <input type="hidden" name="designation" value="Doctor">
                              <input type="text" class="form-control" name="address" placeholder="Address" required>
                          </div>
                          <div class="col-sm-6 form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" placeholder="Enter Email" required name="email">
                          </div>
                          <div class="col-sm-6 form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" placeholder="Enter password" required name="password">
                          </div>

                          <div class="col-sm-6 form-group">
                            <label>Department/Unit</label>
                            <select class="js-example-basic-single form-control" name="department">
                            <!--<select name="department" class="form-control" id="exampleSelect1" name="select" size="1">-->
                              @forelse($departmentss as $department)
                                <option value="{{ $department->name }}">{{$department->name}}</option>
                              @empty
                              @endforelse
                            </select> 
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Specialist</label>
                              <input type="text" name="specialist" class="form-control" placeholder="Specialist" required>
                          </div>
                          <div class="col-sm-6 form-group">
                              <label>Mobile</label>
                              <input type="tel" name="phone" class="form-control" placeholder="Enter Mobile" required>
                          </div>

                           
                          <div class="col-sm-12 form-group">
                              <label>Short Biography</label>
                              <textarea id="some-textarea" name="bio" class="form-control" rows="3" placeholder="Enter text ..."></textarea>
                          </div>        
                          <div class="col-sm-6 form-group">
                              <label>Date of Birth</label>
                              <input  class="datepicker form-control hasDatepicker" type="date" name="dob" placeholder="Date of Birth" id="date_of_birth">
                          </div>
                          <div class="col-sm-6 form-group">
                              <label>Blood group</label>
                              <select class="form-control" name="blood_group" id="exampleSelect">
                                  <option value="A=">A+</option>
                                  <option value="AB+">AB+</option>
                                  <option value="O+">O+</option>
                                  <option value="AB">AB-</option>
                                  <option value="B+">B+</option>
                                  <option value="A-">A-</option>
                                  <option value="B-">B-</option>
                                  <option value="O-">O-</option>
                              </select>
                          </div>

                          <div class="col-sm-6 form-group">
                           <label>Gender</label><br>
                           <label class="radio-inline">
                               <input type="radio" name="gender" value="Male" checked="checked">Male</label> 
                               <label class="radio-inline"><input type="radio" name="gender" value="Female" >Female</label>
                           </div>
                           <div class="col-sm-6 form-check">
                              <label>Status</label><br>
                              <label class="radio-inline"><input type="radio" name="status" value="1" checked="checked">Active</label> 
                              <label class="radio-inline">
                                  <input type="radio" name="status" value="0" >Inctive
                              </label>  
                            </div> 
                            <!--<div class="col-sm-4 form-group">
                                <label >Picture upload</label>
                                <input type="file" name="photo" id="picture">
                            </div> -->
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