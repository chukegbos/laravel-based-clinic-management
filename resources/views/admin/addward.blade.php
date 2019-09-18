@extends('layouts.admin')
@section('pageTitle', 'Add Ward')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title"> 
          <h1>Ward</h1>
          <small>Add Ward</small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
              <li class="active">Add Ward</li>
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
                      <a class="btn btn-primary" href="{{ url('/wards') }}"> <i class="fa fa-list"></i>  Ward List </a>  
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
                  <form class="col-sm-12" method="POST" action="{{ url('addward') }}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="unique_id" value="{{ $random_number }}">
                      <div class="col-sm-4 form-group">
                          <label>Ward Name</label>
                          <input type="text" class="form-control" placeholder="Neuro Ward" required name="name">
                      </div>
                      
                      
                      <div class="col-sm-4 form-group">
                        <label>Gender</label><br>
                        <label class="radio-inline">
                           <input type="radio" name="gender" value="Male" checked="checked">Male
                        </label> 
                        <label class="radio-inline">
                          <input type="radio" name="gender" value="Female" >Female
                        </label>
                      </div>

                       <div class="col-sm-4 form-check">
                        <label>Status</label><br>
                        <label class="radio-inline"><input type="radio" name="status" value="Active" checked="checked">Active</label> 
                        <label class="radio-inline">
                            <input type="radio" name="status" value="Inactive" >Inctive</label>  
                        </div> 

                        <div class="col-sm-12 reset-button">
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