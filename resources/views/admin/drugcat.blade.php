@extends('layouts.admin')
@section('pageTitle', 'Medicine Category')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
              
            <h1>Medicine Category</h1>
            <small>Total Medicine Category in Store.</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Medicine Category</li>
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
                            <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#drugcat" > 
                              <i class="fa fa-plus"></i> Add Category
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

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="example4" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name of Category</th>
                                                <th>Description</th>
                                                <th>No of Drugs Available</th>
                                                <th>Action</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($cats as $drug)
                                            <tr>
                                                <td>{{ $drug->name }}</td>
                                                <td>{{ $drug->description }}</td>
                                                <td>{{ $drug->no_of_drugs }} Drug(s) <a href="{{ url('/alldrugs') }}/?cat={{ $drug->id }}">Click to view</a></td>
                                                <td>
                                                    <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#editcat" > 
                                                      <i class="fa fa-plus"></i> Edit Category
                                                    </a>
                                                    <!--<a href="{{ url('/editcat') }}/?id={{ $drug->id }}">
                                                        <i class="fa fa-edit btn btn-warning btn-xs"></i> 
                                                    </a>-->
                                                </td> 
                                                <div id="editcat" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content ">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                                            <h4 class="modal-title">Edit Category</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="panel panel-bd lobidrag">
                                                                <div class="panel-body">
                                                                    <form class="col-sm-12" method="POST" action="{{ url('/editdrugcat') }}">
                                                                        {{ csrf_field() }}
                                                                        <div class="form-group">
                                                                            <label>Name of Category</label>
                                                                            <input type="hidden" name="id" value="{{ $drug->id }}">
                                                                            <input type="text" class="form-control" name="name" value="{{ $drug->name }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Description</label>
                                                                            <textarea  class="form-control" name="description">{{ $drug->description }}</textarea>
                                                                        </div>
                                                                       
                                                                        <div class="reset button">
                                                                            <button type="submit" class="btn btn-success">Save</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <td>
                                                    <form action="{{ url('/deletecat') }}/{{$drug->id}}" method="POST">
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
            </div>
        </div>
    </section>
</div>

<div id="drugcat" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Add Category</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd lobidrag">
                <div class="panel-body">
                    <form class="col-sm-12" method="POST" action="{{ url('/drugcat') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Name of Category</label>
                            <input type="text" class="form-control" name="name" placeholder="Syrub" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea  class="form-control" name="description"></textarea>
                        </div>
                       
                        <div class="reset button">
                             <a href="#" class="btn btn-primary">Reset</a>
                             <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
@endsection