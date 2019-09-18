@extends('layouts.admin')
@section('pageTitle', 'Change Password')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title"> 
        <h1>Password</h1>
        <small>Change Password</small>
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Change Password</li>
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
                  <div class="row">
                    <div class="col-md-3">
                      
                    </div>
                    <div class="col-md-6">
                      <form class="form-horizontal" method="POST" action="{{ route('changepassword') }}">
                      {{ csrf_field() }}

                      <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                          <label for="new-password" class="col-md-4 control-label">Current Password</label>

                          <div class="col-md-12">
                              <input id="current-password" type="password" class="form-control" name="current-password" required>

                              @if ($errors->has('current-password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('current-password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                          <label for="new-password" class="col-md-4 control-label">New Password</label>

                          <div class="col-md-12">
                              <input id="new-password" type="password" class="form-control" name="new-password" required>

                              @if ($errors->has('new-password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('new-password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                          <div class="col-md-12">
                              <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Change Password
                              </button>
                          </div>
                      </div>
                  </form>
                    </div>
                  </div>
               </div>
           </div>
      </div>
    </div>
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection