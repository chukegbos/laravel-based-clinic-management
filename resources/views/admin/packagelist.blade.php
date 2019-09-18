@extends('layouts.admin')
@section('pageTitle', 'Packages List')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">  
            <h1>All packages</h1>
            <small></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">package List</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#addpackage"> <i class="fa fa-plus"></i> Add packages
                            </a>  
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

                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Amount (Naira)</th>
                                        <th>Discount (Naira)</th>
                                        <th>Total(Amount - Discount)</th>
                                        <th>Action</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($packages as $package)
                                    <tr>
                                        <td><label>{{ $package->name }} Package</label></td>
                                        <td>{{ $package->description }}</td>
                                        <td>{{ $package->amount }}</td>
                                        <td>{{ $package->discount }}</td>
                                        <td>{{ $package->total }}</td>
                                        <td>
                                            <a href="{{ url('/viewpackage') }}/?id={{ $package->id }}">
                                                <i class="fa fa-edit btn btn-info btn-xs"> View Package</i> 
                                            </a>
                                        </td> 
                                        <td>
                                            <form action="{{ url('/deletepackage') }}/{{$package->id}}" method="POST">
                                              {{ csrf_field() }}
                                              {{ Method_field('DELETE') }}
                                              
                                               <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="addpackage" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Add package</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd lobidrag">
                <div class="panel-body">
                    <form method="POST" action="{{ url('/packagelist') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Package Name <i class="text-danger">*</i></label>
                            <input name="name"  type="text" class="form-control" id="name" placeholder="Package Name">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" description="description"  type="text" class="form-control" id="description"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Select Services <i class="text-danger">*</i></label>
                            <fieldset>
                                <div style="height: 7em; overflow-y: auto; white-space: nowrap;">
                                    @forelse($services as $service)
                                        <input type="checkbox"  id="myInput" oninput="myFunction()" name="package[]" value="{{ $service->id }}"/> {{ $service->name }} (N{{ $service->quantity }})<br>
                                    @empty
                                    @endforelse
                                </div>   
                            </fieldset> 
                        </div>

                        <div class="form-group">
                            <label>Discount <i class="text-danger"></i></label>
                            <input name="discount"  type="number" class="form-control">
                        </div>

                        <div class="reset button">
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection