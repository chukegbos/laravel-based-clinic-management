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
                  <form class="col-sm-12" method="POST" action="{{ url('addbed') }}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                      <div class="col-sm-6 form-group">
                          <label>Number</label>
                          <input type="number" class="form-control" required name="number">
                      </div>

                      <div class="col-sm-6 form-group">
                          <label>Select Ward</label>
                          <select name="ward" class="form-control">
                            @forelse($wards as $ward)
                              <option value="{{ $ward->id }}">{{$ward->name}} {{$ward->gender}} Ward</option>
                            @empty
                            @endforelse
                          </select>
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