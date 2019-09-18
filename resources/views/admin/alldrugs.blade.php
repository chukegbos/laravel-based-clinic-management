@extends('layouts.admin')
@section('pageTitle', 'Drug Inventory')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
              
            <h1>Medicine Store</h1>
            <small>Medicine Store</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Medicine Store</li>
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
                            <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#adddrug" > 
                              <i class="fa fa-plus"></i> Add Drug
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

                        @if(isset($prescription))
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="portfolio-item">
                                        <div class="portfolio-image">
                                            <h4>Doctor's Prescription</h4>
                                        </div>
                                        
                                        <div class="portfolio-info">
                                            <p>{{ $prescription }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="table-responsive">
                                        <table id="example4" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Batch Number</th>
                                                    <th>Brand Name</th>
                                                    <th>Genetic Name</th>     
                                                    <th>NAFDAC Number</th>
                                                    <th>Expiry Date</th>
                                                    <th>Regular Price</th>
                                                    <th>Discounted Price</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($drugs as $drug)
                                                <tr>
                                                    <td>
                                                        {{ $drug->batch_number }}   
                                                    </td>

                                                    <td>
                                                        {{ $drug->brand_name }}   
                                                    </td>
                                                    <td>
                                                        {{ $drug->genetic_name }}   
                                                    </td>
                                                    <td>
                                                        {{ $drug->nafdac_number }}   
                                                    </td>
                                                    
                                                    <td>
                                                        {{ $drug->expiry_date }}   
                                                    </td>
                                                    <td>
                                                        {{ $drug->reg_price }}
                                                    </td>
                                                    <td>
                                                        {{ $drug->discount_price }}
                                                    </td>
                                                    <td>
                                                        {{ $drug->quantity }}
                                                    </td>

                                                    <td>
                                                        <label>
                                                            @if ($drug->quantity <= 0)
                                                                <span class="btn btn-warning btn-xs">Out of Stock</span>
                                                            @else
                                                                <a href="{{ url('/addcart') }}/{{$drug->id}}/?sid={{ $sid }}" class="btn btn-info btn-xs">Add to Cart</a>
                                                            @endif
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <form action="{{ url('/deletedrug') }}/{{$drug->id}}" method="POST">
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
                        @else
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="example4" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Batch Number</th>
                                                    <th>Brand Name</th>
                                                    <th>Genetic Name</th>     
                                                    <th>NAFDAC Number</th>
                                                    <th>Expiry Date</th>
                                                    <th>Regular Price</th>
                                                    <th>Discounted Price</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($drugs as $drug)
                                                <tr>
                                                    <td>
                                                        {{ $drug->batch_number }}   
                                                    </td>

                                                    <td>
                                                        {{ $drug->brand_name }}   
                                                    </td>
                                                    <td>
                                                        {{ $drug->genetic_name }}   
                                                    </td>
                                                    <td>
                                                        {{ $drug->nafdac_number }}   
                                                    </td>
                                                    
                                                    <td>
                                                        {{ $drug->expiry_date }}   
                                                    </td>
                                                    <td>
                                                        {{ $drug->reg_price }}
                                                    </td>
                                                    <td>
                                                        {{ $drug->discount_price }}
                                                    </td>
                                                    <td>
                                                        {{ $drug->quantity }}
                                                    </td>

                                                    <td>
                                                        @if ($drug->quantity <= 0)
                                                            <span class="btn btn-warning btn-xs">Out of Stock</span>
                                                        @else
                                                            <a href="{{ url('/addcart') }}/{{$drug->id}}" class="btn btn-info btn-xs">Add to Cart</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ url('/deletedrug') }}/{{$drug->id}}" method="POST">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="adddrug" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Add Drug</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd lobidrag">
                <div class="panel-body">
                    <form class="col-sm-12" method="POST" action="{{ url('/alldrugs') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Medicine Category</label>
                            <select class="form-control" name="category">
                                @forelse($medicats as $medicat)
                                    <option value="{{ $medicat->id }}">{{ $medicat->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text"  onmouseover="this.focus();" class="form-control" name="brand_name" placeholder="Emzor" required>
                        </div>
                        <div class="form-group">
                            <label>Genetic Name</label>
                            <input type="text"  onmouseover="this.focus();" class="form-control" name="genetic_name" placeholder="Paracetamol" required>
                        </div>
                       
                        <div class="form-group">
                            <label>NAFDAC Number</label>
                            <input type="text"  onmouseover="this.focus();" class="form-control" name="nafdac_number" required>
                        </div>
                        <div class="form-group">
                            <label>Batch Number</label>
                            <input type="text"  onmouseover="this.focus();" class="form-control" name="batch_number" required>
                        </div>
                        
                     
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="text"  onmouseover="this.focus();" class="form-control" name="expiry_date" required>
                        </div>
                        <div class="form-group">
                            <label>Regular Price (Amount meant to be sold)</label>
                            <input type="text"  onmouseover="this.focus();" class="form-control" name="reg_price" required>
                        </div>

                        <div class="form-group">
                            <label>Discount Price (Amount to be sold)</label>
                            <input type="text"  onmouseover="this.focus();" class="form-control" name="discount_price" required>
                        </div>
                     
                       <div class="form-group">
                            <label>Quantity</label>
                            <input type="text"  onmouseover="this.focus();" class="form-control" name="quantity" required>
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