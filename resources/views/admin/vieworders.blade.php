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
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                          <th>BRAND NAME</th>
                                          <th>GENETIC NAME</th>
                                          <th>QUANTITY</th>
                                          <th>UNIT PRICE (Naira)</th>
                                          <th>PRICE (Naira)</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($orderss as $item)
                                        <tr>
                                            <td>{{ $item['item']['brand_name']  }}</td>
                                            <td>{{ $item['item']['genetic_name']  }}</td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>{{ $item['item']['discount_price']  }}</td>
                                            <td>{{ $item['discount_price'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th class="text-right  pd-10"></th>
                                            <th></th>
                                            <th class="text-right  pd-10">Total Price</th>
                                            <th class="text-right  pd-10 "><span class="vd_green font-sm font-normal"> N{{ $totalPrice  }}</span></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>                 
                        </div>
                    </div>
                </div>
            </div>
        </section> <!-- /.content -->
</div>
@endsection