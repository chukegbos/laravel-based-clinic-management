@extends('layouts.admin')
@section('pageTitle', "View Package")
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title"> 
          <h1>View Package</h1>
          <small></small>
          <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">View Package</li>
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
              <div class="col-sm-10">
                <p><b>Name of Package: </b>{{ $package->name }} Package</p>
                <p><b>Description of Packages: </b>{{ $package->description }}</p>
              </div>
              <div class="col-sm-2">
                <div class="btn-group"> 
                  <a class="btn btn-success" href="#" data-toggle="modal" data-target="#editpackage"> <i class="fa fa-plus"></i> Edit package
                  </a>  
                </div> 
              </div>
            </div> 
            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Package's Service</th>
                          <th>Description</th>
                          <th>Fee</th>
                          <th>Rate</th>
                        </tr>
                      </thead>
                      <tbody>
                          @forelse($services as $service)
                            @forelse($packages as $package)
                              @if($service->id==$package->package)
                                <tr>
                                  <td>{{ $service->name }}</td>
                                  <td>{{ $service->description }}</td>
                                  <td>{{ $service->quantity }}</td>
                                  <td>{{ $service->rate }}</td>
                                </tr>
                              @endif
                            @empty
                            @endforelse
                          @empty
                          @endforelse

                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><label style="float:right">Amount:</label></td>
                            <td>{{ $package->amount }} Naira</td>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><label style="float:right">Discount:</label></td>
                            <td>{{ $package->discount }} Naira</td>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><label style="float:right">Total:</label></td>
                            <td>{{ $package->total }} Naira</td>
                            <td></td>
                          </tr>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<div id="editpackage" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Edit package</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd lobidrag">
                <div class="panel-body">
                    <form method="POST" action="{{ url('/viewpackage') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Package Name <i class="text-danger">*</i></label>
                            <input name="name"  type="text" class="form-control" id="name" value="{{ $package->name }}">
                            <input name="id"  type="hidden" value="{{ $package->id }}">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" description="description"  type="text" class="form-control" id="description"> {{ $package->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Select Services <i class="text-danger">*</i></label>
                            <fieldset>
                                <div style="height: 7em; overflow-y: auto; white-space: nowrap;">
                              
                                      @forelse($services as $service)
                                        
                                        @if(in_array($service->id, $service_id)) 
                                          <input type="checkbox" checked="" name="package[]" value="{{ $service->id }}"/> {{ $service->name }} (N{{ $service->quantity }})<br>
                                        @else
                                          <input type="checkbox" name="package[]" value="{{ $service->id }}"/> {{ $service->name }} (N{{ $service->quantity }})<br>
                                        @endif
                                      @empty
                                      @endforelse
                                </div>   
                            </fieldset> 
                        </div>

                        <div class="form-group">
                            <label>Discount <i class="text-danger"></i></label>
                            <input name="discount"  type="number" value="{{ $package->discount }}" class="form-control">
                        </div>

                        <div class="reset button">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection