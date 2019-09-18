@extends('layouts.admin')
@section('pageTitle', 'Cart')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>   
            <h1>Pharmacy Cart</h1>
            <small>Pharmacy Cart</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Pharmacy Cart</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->

       <section class="content">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="panel panel-bd">
                        <div class="panel-body">
                            @if (Session::has('cart'))
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                  
                                  <th>DRUG</th>
                                  <th class="text-center">QTY</th>
                                  <th class="text-right">UNIT PRICE (Naira)</th>

                                  <th class="text-right">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                      
                                      <td>{{ $product['item']{'genetic_name'} }}</td>
                                      <td class="text-center">{{ $product['quantity'] }}</td>
                                      <td class="text-right">N {{ $product['discount_price'] }}</td>
                                      <td class="text-right">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                            Action
                                            <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu">
                                            <li><a href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}"> <span style="padding: 4px">Reduce by 1 </span></a></li>
                                            <li><a href="{{ route('product.remove', ['id' => $product['item']['id']]) }}"> <span style="padding: 4px">Reduce All</a></span></li>
                                          </ul>
                                        </div>
                                      </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th class="text-right  pd-10"></th>
                                        <th class="text-right  pd-10">Total Price</th>
                                        <th class="text-right  pd-10 "><span class="vd_green font-sm font-normal"> N{{ $totalPrice }}</span></th>
                                        <th></th>
                                    </tr>
                                    <form method="post" action="{{ url('/shoppingcart') }}">
                                        {{ csrf_field() }}
                                    <tr>
                                        <th class="text-center"><a href="{{ url('/alldrugs') }}" class="btn btn-info">Back</a></th>
                                        <th>
                                            Select Mode of Payment
                                            <select class="form-control" name="mop">
                                                <option value="Cash">Cash</option>
                                                <option value="Mobile Transfer">Mobile Transfer</option>
                                                <option value="POS">POS</option>
                                            </select>
                                        </th>
                                        <th class="text-right">
                                            <button type="submit" class="btn btn-success">Checkout</button>
                                            </form>
                                        </th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>  
                            @else
                                <h4>No item in cart!!!</h4>
                            @endif                  
                        </div>
                    </div>
                </div>
            </div>
        </section> <!-- /.content -->
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
                            <label>Brand Name</label>
                            <input type="text" class="form-control" name="brand_name" placeholder="Emzor" required>
                        </div>
                        <div class="form-group">
                            <label>Genetic Name</label>
                            <input type="text" class="form-control" name="genetic_name" placeholder="Paracetamol" required>
                        </div>
                       
                        <div class="form-group">
                            <label>NAFDAC Number</label>
                            <input type="text" class="form-control" name="nafdac_number" required>
                        </div>
                        <div class="form-group">
                            <label>Batch Number</label>
                            <input type="text" class="form-control" name="batch_number" required>
                        </div>
                        
                     
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="date" class="form-control" name="expiry_date" required>
                        </div>
                        <div class="form-group">
                            <label>Regular Price (Amount meant to be sold)</label>
                            <input type="number" class="form-control" name="reg_price" required>
                        </div>

                        <div class="form-group">
                            <label>Discount Price (Amount to be sold)</label>
                            <input type="number" class="form-control" name="discount_price" required>
                        </div>
                     
                       <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="quantity" required>
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