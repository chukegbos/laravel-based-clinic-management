@extends('layouts.admin')
@section('pageTitle', 'Drug Sales')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-tachometer"></i>
        </div>
        <div class="header-title">
            <h1> Drug Sales</h1>
            <small></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Drug Sales</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <a href="{{ url('/drugsale') }}/?today=today"> 
                    <div class="panel panel-bd" style="color: white; background: green">
                        <div class="panel-body">
                            <div class="statistic-box" style="padding: 10px; color: white">
                                <div class="row">
                                    <span style="font-size: 20px; color: white">Today's Sales</span><br>
                                    <p>Total Sales For This Today</p>
                                </div>
                                
                                <div class="row">
                                    <h2>
                                        <span>&#8358;</span>
                                        <span class="count-number"> {{ number_format($todayorders) }}</span>
                                    </h2>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-3">
                <a href="{{ url('/drugsale') }}/?week=week"> 
                    <div class="panel panel-bd" style="color: white; background: #e20dd4">
                        <div class="panel-body">
                            <div class="statistic-box" style="padding: 10px; color: white">
                                <div class="row">
                                    <span style="font-size: 20px; color: white">Week Sales    </span><br>
                                    <p>Total Sales For This Week</p>
                                </div>
                                
                                <div class="row">
                                    <h2>
                                        <span>&#8358;</span>
                                        <span class="count-number"> {{ number_format($weekorders) }}</span>
                                    </h2>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-3">
                <a href="{{ url('/drugsale') }}/?month=month"> 
                    <div class="panel panel-bd" style="color: white; background: #8e6969">
                        <div class="panel-body">
                            <div class="statistic-box" style="padding: 10px; color: white">
                                <div class="row">
                                    <span style="font-size: 20px; color: white">{{ date('M') }} Sales</span><br>
                                    <p>Total Sales For This Month</p>
                                </div>
                                <div class="row">
                                    <h2>
                                        <span>&#8358;</span>
                                        <span class="count-number"> {{ number_format($monthorders) }}</span>
                                    </h2>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
              
            <div class="col-sm-6 col-md-3">
                <a href="{{ url('/drugsale') }}/?year=year"> 
                    <div class="panel panel-bd" style="color: white; background: black">
                        <div class="panel-body">
                            <div class="statistic-box" style="padding: 10px; color: white">
                                <div class="row">
                                    <span style="font-size: 20px; color: white">{{ date('Y') }} Sales</span><br>
                                    <p>Total Sales Performed This Year</p>
                                </div>
                                
                                <div class="row">
                                    <h2>
                                        <span>&#8358;</span>
                                        <span class="count-number"> {{ number_format($yearorders) }}</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        @if(isset($today) || isset($week) || isset($month) || isset($year))
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-header" style="text-align: center">
                            <h3>
                                @if(isset($today))
                                    Today's
                                @elseif(isset($week))
                                    This Week's
                                @elseif(isset($month))
                                    This Month's
                                @else
                                    This Year's
                                @endif
                                Sales
                            </h3>
                            <h4>
                                Total Sale: 
                                @if(isset($today))
                                    <span>&#8358;</span>
                                    <span class="count-number"> {{ number_format($todayorders) }}</span>
                                @elseif(isset($week))
                                    <span>&#8358;</span>
                                    <span class="count-number"> {{ number_format($weekorders) }}</span>
                                @elseif(isset($month))
                                    <span>&#8358;</span>
                                    <span class="count-number"> {{ number_format($monthorders) }}</span>
                                @else
                                    <span>&#8358;</span>
                                    <span class="count-number"> {{ number_format($yearorders) }}</span>
                                @endif
                            </h4>
                        </div>

                        <div class="panel-body">
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
        @endif
    </section>
</div>
@endsection