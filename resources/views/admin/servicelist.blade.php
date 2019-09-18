@extends('layouts.admin')
@section('pageTitle', 'Services List')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">  
            <h1>All Services</h1>
            <small></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Service List</li>
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
                            <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#addservice"> <i class="fa fa-plus"></i> Add Services
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
                                        <th>Fee</th>
                                        <th>Rate</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($services as $service)
                                    <tr>
                                        <td><label>{{ $service->name }}</label></td>
                                        <td>{{ $service->description }}</td>
                                        <td>{{ $service->quantity }}</td>
                                        <td>{{ $service->rate }}</td>
                                        <td>
                                            <a href="{{ url('/editservice') }}/?id={{ $service->id }}">
                                                <i class="fa fa-edit btn btn-warning btn-xs"></i> 
                                            </a>
                                        </td> 
                                        <td>
                                            <form action="{{ url('/deleteservice') }}/{{$service->id}}" method="POST">
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


<div id="addservice" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Add Service</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd lobidrag">
                <div class="panel-body">
                    <form class="col-sm-12" method="POST" action="{{ url('/servicelist') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Name of Service</label>
                            <input type="text" class="form-control" name="name" placeholder=" Ambulance Service" required>
                        </div>
                        <div class="form-group">
                            <label>Description of Service</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>                      
                        <div class="form-group">
                            <label>Quantity/Price</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>                      
                        <div class="form-group">
                            <label>Rate (Per Day/Per Service</label>
                            <input type="number" class="form-control" name="rate">
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



<script>
  //service modal
  $(document).on("click", ".open-AddBookDialog", function () {
     var bookId = $(this).data('id');
     var bookName = $(this).data('name');
     var bookDescription = $(this).data('description');
     var bookQuantity = $(this).data('quantity');
     var bookRate = $(this).data('rate');

     $(".modal-body #mainid").val( bookId );
     $(".modal-body #mainname").val( bookName );
     $(".modal-body #maindescription").val( bookDescription );
     $(".modal-body #mainquantity").val( bookQuantity );
     $(".modal-body #mainrate").val( bookRate );
    $('#editmodal').modal('show');
  });
</script>
@endsection