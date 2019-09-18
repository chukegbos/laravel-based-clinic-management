@extends('layouts.admin')
@section('pageTitle', 'Medicine Store')
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
                            <table id="example3" class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Order ID</th>
                                  <th>Admin</th>
                                  <th>Total Price (Naira)</th>
                                  <th>Date</th>
                                  <th>Action</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                                @forelse($orders as $order)
                                <tr>
                                  <td>{{ $order->payment_id }}</td>
                                 
                                  <td>{{ $order->agent}}</td>
                                  <td>N{{ $order->cart->totalPrice }}</td>  
                                  <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                  <td><a href="{{ url('/vieworders') }}/?pid={{ $order->payment_id }}" class="btn btn-success">View</a></td>                 
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
@endsection