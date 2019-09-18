@extends('layouts.admin')
@section('pageTitle', 'Edit Patient')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="header-icon">
        <i class="pe-7s-note2"></i>
    </div>
    <div class="header-title"> 
        <h1>{{ $patient->lname }} {{ $patient->fname }} {{ $patient->mname }}'s Profile</h1>
        <small>Edit Profile</small>
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Edit Patient</li>
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
                      <form class="col-sm-12" method="POST" action="{{ url('editpatient') }}"  enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                          <div class="col-sm-4 form-group">
                              <label>First Name</label>
                              <input type="text" class="form-control" value="{{ $patient->fname }}" required name="fname">
                          </div>
                          <div class="col-sm-4 form-group">
                              <label>Middle Name</label>
                              <input type="text" class="form-control" value="{{ $patient->mname }}" required name="mname">
                          </div>

                          <div class="col-sm-4 form-group">
                              <label>Last Name</label>
                              <input type="text" class="form-control" value="{{ $patient->lname }}" required name="lname">
                              <input type="hidden"  value="{{ $patient->unique_id }}" name="unique_id">
                          </div>


                          <div class="col-sm-6 form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" value="{{ $patient->email }}" readonly="true" name="email">
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Mobile Number</label>
                              <input type="tel" name="phone" class="form-control" value="{{ $patient->phone }}" required>
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Address</label>
                              <textarea class="form-control" name="address">{{ $patient->address }}</textarea>
                          </div>

                          <div class="col-sm-6 form-group">
                              <label>Short Biography</label>
                              <textarea id="some-textarea" name="bio" class="form-control">{{ $patient->bio }}</textarea>
                          </div>        
                          <div class="col-sm-4 form-group">
                              <label>Date of Birth</label>
                              <input  class="datepicker form-control hasDatepicker" type="date" name="dob" value="Date of Birth" id="date_of_birth">
                          </div>

                          <div class="col-sm-4 form-group">
                              <label>Genotype</label>
                              <select class="form-control" name="genotype" id="exampleSelect">
                                  <option value="AA" {{ $patient->genotype == "AA" ? 'selected' : '' }}>AA</option>
                                  <option value="AS" {{ $patient->genotype == "AS" ? 'selected' : '' }}>AS</option>
                                  <option value="SS" {{ $patient->genotype == "SS" ? 'selected' : '' }}>SS</option>
                              </select>
                          </div>


                          <div class="col-sm-4 form-group">
                              <label>Blood group</label>
                              <select class="form-control" name="blood_group" id="exampleSelect">
                                  <option value="A+" {{ $patient->blood_group == "A" ? 'selected' : '' }}>A+</option>
                                  <option value="AB+" {{ $patient->blood_group == "AB+" ? 'selected' : '' }}>AB+</option>
                                  <option value="O+" {{ $patient->blood_group == "AB" ? 'selected' : '' }}>O+</option>
                                  <option value="AB" {{ $patient->blood_group == "AB-" ? 'selected' : '' }}>AB-</option>
                                  <option value="B+" {{ $patient->blood_group == "B+" ? 'selected' : '' }}>B+</option>
                                  <option value="A-" {{ $patient->blood_group == "A-" ? 'selected' : '' }}>A-</option>
                                  <option value="B-" {{ $patient->blood_group == "B-" ? 'selected' : '' }}>B-</option>
                                  <option value="O-" {{ $patient->blood_group == "0-" ? 'selected' : '' }}>O-</option>
                              </select>
                          </div>

                          <div class="col-sm-3 form-group">
                            <label>Gender</label><br>
                            <label class="radio-inline">
                              <input type="radio" name="gender" value="Male"  {{ $patient->gender == "Male" ? 'checked' : '' }}>Male
                            </label> 

                
                            <label class="radio-inline">
                              <input type="radio" name="gender" value="Female"  {{ $patient->gender == "Female" ? 'checked' : '' }}>Female
                            </label>
                          </div>


                          <div class="col-sm-6 form-group">
                            <label>Marital Status</label><br>
                            <label class="radio-inline">
                              <input type="radio" name="marital_status" value="Single"  {{ $patient->marital_status == "Single" ? 'checked' : '' }}>Single
                            </label> 
                            <label class="radio-inline">
                              <input type="radio" name="marital_status" value="Married"  {{ $patient->marital_status == "Married" ? 'checked' : '' }}>Married
                            </label> 
                            <label class="radio-inline">
                              <input type="radio" name="marital_status" value="Divorced"  {{ $patient->marital_status == "Divorced" ? 'checked' : '' }}>Divorced
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="marital_status" value="Widow/Widower"  {{ $patient->marital_status == "Widow/Widower" ? 'checked' : '' }}>Widow/Widower
                            </label>
                          </div>


                          <div class="col-sm-3 form-check">
                            <label>Account Status</label><br>
                            <label class="radio-inline">
                              <input type="radio" name="status" value="1"  {{ $patient->status == "1" ? 'checked' : '' }}>Active
                            </label> 

                            <label class="radio-inline">
                              <input type="radio" name="status" value="0"  {{ $patient->status == "0" ? 'checked' : '' }}>Inactive
                            </label>  
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